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

use App\Http\Resources\Siswa\SiswaResource;

use App\Http\Requests\Assessment\AssessmentRequest;

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
            
            $data = Siswa::all();

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
      
        return view('assessment.index', ['active'=>'assessment']);
    }

    /**
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function assessment($id_siswa, Request $request)
    {
    	$data_siswa = Siswa::findOrFail($id_siswa);

        if ($request->ajax()) 
        {
            if($data_siswa->memorization_type != Siswa::TYPE_IQRO)
            {
                $data = SiswaHasSurah::where('siswa_id',$id_siswa)->orderBy('created_at', 'desc')->get();

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('surah_id', function(SiswaHasSurah $surah) {
                        return $surah->getSurah->surah_name;
                    })
                    ->addColumn('date', function(SiswaHasSurah $date) {
                        return date("d M Y", strtotime($date->date));
                    })
                    ->rawColumns(['action'])
                    ->toJson();
            }
            else if($data_siswa->memorization_type == Siswa::TYPE_IQRO)
            {
                $data = SiswaHasIqro::where('siswa_id',$id_siswa)->orderBy('created_at', 'desc')->get();

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('iqro_id', function(SiswaHasIqro $iqro) {
                        return 'Jilid '.$iqro->getIqro->jilid_number;
                    })
                    ->addColumn('date', function(SiswaHasIqro $date) {
                        return date("d M Y", strtotime($date->date));
                    })
                    ->rawColumns(['action'])
                    ->toJson();
            }
        } 

    	if($data_siswa->memorization_type != Siswa::TYPE_IQRO)
    	{           
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

    		return view('assessment.assessment_iqro', [
                'active'=>'assessment',
                'data_siswa'=>$data_siswa,
                'iqro_arr' => $iqro_arr
            ]);
    	}
    }

    /**
     * @return void
     */
    public function doAssessment(AssessmentRequest $request)
    {
        DB::beginTransaction();

        if($request->get('end') < $request->get('begin'))
        {
            return redirect()->route('create-assessment', [ 'type'=> $request->get('id_siswa') ])->with('alert_error', 'Gagal Disimpan');
        }

        if(Siswa::findOrFail($request->get('id_siswa'))->memorization_type != Siswa::TYPE_IQRO)
        {
            for ($ayat = $request->get('begin'); $ayat <= $request->get('end'); $ayat++) 
            {
                $assessment = new SiswaHasSurah();
                $assessment->siswa_id = $request->get('id_siswa');
                $assessment->surah_id = $request->get('surah_id');
                $assessment->ayat = $ayat;
                $assessment->date = date("Y-m-d H:i:s");
                $assessment->note = $request->get('note');

                if(SiswaHasSurah::AssessmentValidation($assessment->siswa_id,$assessment->surah_id,$assessment->ayat))
                {
                    DB::rollBack();
                    return redirect()->route('create-assessment', [ 'type'=> $request->get('id_siswa') ])->with('alert_error', 'Gagal Disimpan, Siswa ini sudah menyelesaikan untuk hafalan degan Surat '.$assessment->getSurah->surah_name.' Ayat '.$assessment->ayat.'');
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
            for ($page = $request->get('begin'); $page <= $request->get('end'); $page++) 
            {
                $assessment = new SiswaHasIqro();
                $assessment->siswa_id = $request->get('id_siswa');
                $assessment->iqro_id = $request->get('iqro_id');
                $assessment->page = $page;
                $assessment->date = date("Y-m-d H:i:s");
                $assessment->note = $request->get('note');

                if(SiswaHasIqro::AssessmentValidation($assessment->siswa_id,$assessment->iqro_id,$assessment->page))
                {
                    DB::rollBack();
                    return redirect()->route('create-assessment', [ 'type'=> $request->get('id_siswa') ])->with('alert_error', 'Gagal Disimpan, Siswa ini sudah menyelesaikan untuk hafalan Iqro '.$assessment->getIqro->jilid_number.' Halaman '.$assessment->page.'');
                }

                if(!$assessment->save())
                {
                    DB::rollBack();
                    return redirect()->route('create-assessment', [ 'type'=> $request->get('id_siswa') ])->with('alert_error', 'Gagal Disimpan');
                }
            }
        }

        DB::commit();
        return redirect()->route('create-assessment', [ 'type'=> $request->get('id_siswa') ])->with('alert_success', 'Berhasil Disimpan');
    }

    /**
     * @return void
     */
    public function getAyat(Request $request)
    {
        if ($request->ajax()) {
            $data_surah = Surah::findOrFail($request->get('id_ayat'));
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
                    $arr_data[$key]['text'] = $data->surah_name .' (Juz '.$data->juz.')';
                    $key++;
                }
            }

            return json_encode($arr_data);
        }
    }

}
