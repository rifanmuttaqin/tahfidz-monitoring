<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use App\Model\User\User;
use App\Model\StudentClass\StudentClass;

use App\Http\Requests\StudentClass\StoreStudentClassRequest;

use App\Http\Resources\StudentClass\StudentClassResource;
use App\Http\Resources\StudentClass\StudentClassCollection;

use DB;

class StudentClassController extends Controller
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

            $data = StudentClass::all();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){  
                        $btn = '<button onclick="btnUbah('.$row->id.')" name="btnUbah" type="button" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span></button>';
                        $delete = '<button onclick="btnDel('.$row->id.')" name="btnDel" type="button" class="btn btn-info"><span class="glyphicon glyphicon-trash"></span></button>';
                        return $btn .'&nbsp'. $delete; 
                    })
                    ->addColumn('guru', function(StudentClass $class) {
                        return $class->getTeacher->full_name;
                    }) 
                    ->rawColumns(['action'])
                    ->toJson();
        }

        return view('student_class.index', ['active'=>'student_class']);
    }

    /**
     * @return void
     */
    public function create()
    {
        $years = array_combine(range(date("Y"), 2001), range(date("Y"), 2001));
        return view('student_class.store', ['active'=>'student_class','years'=>$years]);
    }

    /**
     * @return void
     */
    public function store(StoreStudentClassRequest $request)
    {
        DB::beginTransaction();

        $student_class = new StudentClass();

        if(StudentClass::validateClass($request->get('angkatan'),$request->get('class_name'),$request->get('teacher_id')))
        {
            return redirect('student-class')->with('alert_error', 'Kelas dengan tahun yang sama dan guru yang sama sudah dibuat sebelumnya');
        }
        
        $student_class->angkatan = $request->get('angkatan');
        $student_class->class_name = $request->get('class_name');
        $student_class->note = $request->get('note');
        $student_class->teacher_id = $request->get('teacher_id');

        if(!$student_class->save())
        {
            DB::rollBack();
            return redirect('student-class')->with('alert_error', 'Gagal Disimpan');
        }

        DB::commit();
        return redirect('student-class')->with('alert_success', 'Berhasil Disimpan');
    }

     /**
     * @return void
     */
    public function getUserTeacher(Request $request)
    {
        if ($request->ajax()) {

            $data_guru = User::getTeacher();
            $arr_data  = array();
            
            if($data_guru)
            {
                $key = 0;

                foreach ($data_guru as $data) {
                    $arr_data[$key]['id'] = $data->id;
                    $arr_data[$key]['text'] = $data->full_name;
                    $key++;
                }
            }

            return json_encode($arr_data);
        }
    }

    // ------------------------------ Aditional Function -------------------

    
    
}
