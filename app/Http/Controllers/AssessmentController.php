<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use App\Model\Siswa\Siswa;
use App\Model\StudentClass\StudentClass;
use App\Model\User\User;

use App\Model\Iqro\Iqro;

use App\Model\Surah\Surah;
use App\Model\SiswaHasSurah\SiswaHasSurah;
use App\Model\SiswaHasIqro\SiswaHasIqro;

use App\Model\AssessmentLog\AssessmentLog;

use App\Http\Resources\Siswa\SiswaResource;

use App\Http\Requests\Assessment\AssessmentRequest;

use Carbon\Carbon;

use DB;

class AssessmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

     /**
     * Show the application index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            
            if($this->getUserLogin()->account_type == User::ACCOUNT_TYPE_TEACHER)
            {
                $data = Siswa::where('teacher_id',$this->getUserLogin()->id)->join('tbl_class', 'tbl_siswa.class_id', '=', 'tbl_class.id')->get(['tbl_siswa.id','siswa_name','memorization_type','class_id']);
            }
            else
            {
                $data = Siswa::all();
            }

			return Datatables::of($data)
			    ->addIndexColumn()
			    ->addColumn('action', function($row){  
			        $btn = '<button name="btnAssessment" onclick="btnAss('.$row->id.')" type="button" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span></button>';
			        return $btn; 
			    })
			    ->addColumn('memorization_type', function(Siswa $value) {
			        return Siswa::getHafalanMeaning($value->memorization_type);
			    })
			    ->addColumn('class_id', function(Siswa $class) {
			        return $class->getClass->class_name.' ('.$class->getClass->angkatan.')';
			    })
			    ->rawColumns(['action'])
			    ->toJson();
        }

        if($this->getUserPermission('index assessment'))
        {
            $this->systemLog(false,'Mengakses Halaman Assessment');
            return view('assessment.index', ['active'=>'assessment']);
        }
        else
        {
            $this->systemLog(true,'Gagal Mengakses Halaman Assessment');
            return view('error.unauthorized', ['active'=>'assessment']);
        }
    }

    /**
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function assessment($id_siswa, Request $request)
    {
    	$data_siswa = Siswa::findOrFail($id_siswa);

        if ($request->ajax()) 
        {

            $data = AssessmentLog::where('siswa_id',$id_siswa)->orderBy('created_at', 'desc')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('assessment', function(AssessmentLog $data) {
                    return $data->assessment;
                })
                ->addColumn('date', function(AssessmentLog $date) {
                    $date =  Carbon::parse($date->date);
                    return $date->format('d M Y h:i');
                })
                ->rawColumns(['action'])
                ->toJson();
        }

        if($this->getUserPermission('create assessment'))
        {
            if($data_siswa->memorization_type != Siswa::TYPE_IQRO)
            {
                $this->systemLog(false,'Mengakses Halaman Assessment');           
                return view('assessment.assessment_quran',[
                    'active'=>'assessment',
                    'data_siswa'=>$data_siswa
                ]);
            }
            else if($data_siswa->memorization_type == Siswa::TYPE_IQRO)
            {
                $data_iqro  = Iqro::all();
                $iqro_arr   = [];

                foreach ($data_iqro as $iqro) 
                {
                    $iqro_arr[$iqro->id] = $iqro->jilid_number;
                }

                $this->systemLog(false,'Mengakses Halaman Assessment');
                return view('assessment.assessment_iqro', [
                    'active'=>'assessment',
                    'data_siswa'=>$data_siswa,
                    'iqro_arr' => $iqro_arr
                ]);
            }
        }
        else
        {
            $this->systemLog(true,'Gagal Mengakses Halaman Assessment');
            return view('error.unauthorized', ['active'=>'assessment']);
        } 
    }

    /**
     * @return void
     */
    public function doAssessment(AssessmentRequest $request)
    {
        DB::beginTransaction();

        $status_assessment = null;

        if($request->get('end') < $request->get('begin'))
        {
            return redirect()->route('create-assessment', [ 'type'=> $request->get('id_siswa') ])->with('alert_error', 'Gagal Disimpan');
        }

        if(Siswa::findOrFail($request->get('id_siswa'))->memorization_type != Siswa::TYPE_IQRO)
        {
            $assessment_log = new AssessmentLog();
            $assessment_log->siswa_id = $request->get('id_siswa');
            $assessment_log->range = $request->get('begin').'-'.$request->get('end');
            $assessment_log->date = Carbon::now();
            $assessment_log->assessment = 'Surat '.Surah::findOrFail($request->get('surah_id'))->surah_name;
            $assessment_log->note = $request->get('note');

            if(!$assessment_log->save())
            {
                $this->systemLog(true,'Gagal Melakukan Assessment Kepada : '.$assessment->siswa_id.'');
                DB::rollBack();
                return redirect()->route('create-assessment', [ 'type'=> $request->get('id_siswa') ])->with('alert_error', 'Gagal Disimpan');
            }

            for ($ayat = $request->get('begin'); $ayat <= $request->get('end'); $ayat++) 
            {
                $assessment = new SiswaHasSurah();
                $assessment->siswa_id = $request->get('id_siswa');
                $assessment->surah_id = $request->get('surah_id');
                $assessment->ayat = $ayat;
                $assessment->date = Carbon::now();
                $assessment->note = $request->get('note');
                $assessment->group_ayat = $request->get('begin').'-'.$request->get('end');

                $old_data = SiswaHasSurah::AssessmentValidation($assessment->siswa_id,$assessment->surah_id,$assessment->ayat);

                if($old_data != null)
                {
                    $assessment = $old_data;
                    $assessment->date = Carbon::now();
                    $assessment->note = $request->get('note');
                    $assessment->group_ayat = $request->get('begin').'-'.$request->get('end');
                    $status_assessment = 'RENEW';

                    if(!$assessment->save())
                    {
                        DB::rollBack();
                        return redirect()->route('create-assessment', [ 'type'=> $request->get('id_siswa') ])->with('alert_error', 'Gagal Diperbaharui');
                    }
                }

                if(!$assessment->save())
                {
                    DB::rollBack();
                    return redirect()->route('create-assessment', [ 'type'=> $request->get('id_siswa') ])->with('alert_error', 'Gagal Disimpan');
                }
            }
        }
        else if(Siswa::findOrFail($request->get('id_siswa'))->memorization_type == Siswa::TYPE_IQRO)
        {
            $assessment_log = new AssessmentLog();
            $assessment_log->siswa_id = $request->get('id_siswa');
            $assessment_log->range = $request->get('begin').'-'.$request->get('end');
            $assessment_log->date = Carbon::now();
            $assessment_log->assessment = 'Iqro Jilid '.Iqro::findOrFail($request->get('iqro_id'))->jilid_number;
            $assessment_log->note = $request->get('note');

            if(!$assessment_log->save())
            {
                $this->systemLog(true,'Gagal Melakukan Assessment Kepada : '.$assessment->siswa_id.'');
                DB::rollBack();
                return redirect()->route('create-assessment', [ 'type'=> $request->get('id_siswa') ])->with('alert_error', 'Gagal Disimpan');
            }

            for ($page = $request->get('begin'); $page <= $request->get('end'); $page++) 
            {
                $assessment = new SiswaHasIqro();
                $assessment->siswa_id = $request->get('id_siswa');
                $assessment->iqro_id = $request->get('iqro_id');
                $assessment->page = $page;
                $assessment->date = Carbon::now();
                $assessment->note = $request->get('note');
                $assessment->group_page = $request->get('begin').'-'.$request->get('end');

                $old_data = SiswaHasIqro::AssessmentValidation($assessment->siswa_id,$assessment->iqro_id,$assessment->page);

                if($old_data != null)
                {
                    $assessment = $old_data;
                    $assessment->date = Carbon::now();
                    $assessment->note = $request->get('note');
                    $assessment->group_page = $request->get('begin').'-'.$request->get('end');
                    $status_assessment = 'RENEW';

                    if(!$assessment->save())
                    {
                        DB::rollBack();
                        return redirect()->route('create-assessment', [ 'type'=> $request->get('id_siswa') ])->with('alert_error', 'Gagal Diperbaharui');
                    }
                }

                if(!$assessment->save())
                {
                    DB::rollBack();
                    return redirect()->route('create-assessment', [ 'type'=> $request->get('id_siswa') ])->with('alert_error', 'Gagal Disimpan');
                }
            }
        }

        if($this->getUserPermission('create assessment'))
        {            
            $this->systemLog(false,'Melakukan Assessment Kepada : '.$assessment->siswa_id.'');
            DB::commit();

            if($status_assessment == 'RENEW')
            {
                return redirect()->route('create-assessment', [ 'type'=> $request->get('id_siswa') ])->with('alert_success', 'Penilaian telah berhasil diperbaharui');
            }
            else
            {
                return redirect()->route('create-assessment', [ 'type'=> $request->get('id_siswa') ])->with('alert_success', 'Berhasil Disimpan');
            }  
        }
        else
        {
            DB::rollBack();
            return redirect()->route('create-assessment', [ 'type'=> $request->get('id_siswa') ])->with('alert_error', 'Gagal Disimpan');
        }
    }

    /**
     * @return void
     */
    public function getAyat(Request $request)
    {
        if ($request->ajax()) {
            $data_surah = Surah::findOrFail($request->get('id_ayat'));
            $this->systemLog(false,'Menarik data Ayat');
            return json_encode($data_surah->total_ayat);
        }
    }

    /**
     * @return void
     */
    public function getPage(Request $request)
    {
        if ($request->ajax()) {
            $data_iqro = Iqro::findOrFail($request->get('iqro_id'));
            $this->systemLog(false,'Menarik data Iqro');
            return json_encode($data_iqro->total_page);
        }
    }

    /**
     * @return void
     */
    public function getSurah(Request $request)
    {
        if ($request->ajax()) {
            
            if($request->has('search'))
            {
                $data_surah = Surah::getSurah($request->get('search'));
            }
            else
            {
                $data_surah = Surah::getSurah();
            }

            $arr_data  = array();

            if($data_surah)
            {
                $key = 0;

                foreach ($data_surah as $data) {
                    $arr_data[$key]['id'] = $data->id;
                    $arr_data[$key]['text'] = $data->surah_name;
                    $key++;
                }
            }

            $this->systemLog(false,'Menarik data Surah');
            return json_encode($arr_data);
        }
    }
}
