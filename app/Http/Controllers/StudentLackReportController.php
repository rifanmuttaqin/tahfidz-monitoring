<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Siswa\Siswa;

use App\Model\SiswaHasSurah\SiswaHasSurah;
use App\Model\StudentClass\StudentClass;

use App\Model\Surah\Surah;

use App\Model\AssessmentLog\AssessmentLog;

class StudentLackReportController extends Controller
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
        return view('student-lack-report.index', ['active'=>'student-lack-report']);
    }

    /**
     *
     */
    public function printPdf(Request $request)
    {
        $class_id = $request->session()->get('class_id');
        $data_siswa = $request->session()->get('data_siswa');
        $surah = $request->session()->get('surah');
        $surah_max_ayat = $request->session()->get('surah_max_ayat');

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('student-lack-report.print',[
            'class_id' => $class_id,
            'data_siswa' => $data_siswa,
            'surah' => $surah,
            'surah_max_ayat' => $surah_max_ayat
        ]);

        return $pdf->stream();
    }

     /**
     *
     */
    public function show(Request $request)
    {
        if ($request->ajax()) {
            
            $data_siswa = Siswa::where('class_id',$request->get('kelas'))
            ->where('memorization_type',Siswa::TYPE_QURAN)->get();

            // Store data in session
            $request->session()->put('class_id', StudentClass::findOrFail($request->get('kelas'))->class_name);
            $request->session()->put('data_siswa', $data_siswa);
            $request->session()->put('surah', Surah::findOrFail($request->get('surah'))->id);
           
            if($data_siswa->isEmpty())
            {
                $empty_data = 
                
                '<div class="alert alert-danger" role="alert">
                    <p> <strong> Maaf, Data yang anda cari tidak ditemukan pada tanggal tersebut !! </strong> </p>
                </div>';

                return $this->getResponse(false,200,$empty_data,'Berhasil menarik data');
            }
            
            $table = '<table class="table table-striped">';
            $table .= '<thead>';
            $table .= '<tr>';
            $table .= '<th> Nama Siswa/Siswi </th>';
            $table .= '<th> Yang Diselesaikan </th>';
            $table .= '<th> Kekurangan </th>';
            $table .= '</tr>';
            $table .= '</thead>';
            $table .= '<tbody>';

            $surah_max_ayat = Surah::findOrFail($request->get('surah'))->total_ayat;
            $request->session()->put('surah_max_ayat', $surah_max_ayat);
            
            foreach ($data_siswa as $siswa) 
            {
                $data_assessment_siswa = SiswaHasSurah::where('surah_id',$request->get('surah'))
                ->where('siswa_id',$siswa->id)->get();
                
                $lack_list = [];

                foreach ($data_assessment_siswa as $assessment) 
                {
                    array_push($lack_list, $assessment->ayat);
                }

                $max = 0;
                $min = 0;

                if($lack_list != null)
                {
                    $max = max($lack_list);
                    $min = min($lack_list);
                }  

                $begin = $max + 1;
                $end = $surah_max_ayat - $max;

                $table .= '<tr>';               
                $table .= '<td>'.$siswa->siswa_name.'</td>';
                $table .= '<td> Antara Ayat '.$min.' - '.$max.'</td>';
                
                if($end != 0)
                {
                    $table .= '<td> Antara Ayat '.$begin.' - '. $end .'</td>';
                }
                else
                {
                    $table .= '<td> Selesai </td>';
                }
                
                $table .= '</tr>';
            }
            
            $table .= '</tbody>';
            $table .= '</table>';

            return $this->getResponse(true,200,$table,'Berhasil menarik data');
        }
    }
}
