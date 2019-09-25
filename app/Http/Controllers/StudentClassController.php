<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use App\Model\User\User;
use App\Model\StudentClass\StudentClass;

use App\Http\Requests\StudentClass\StoreStudentClassRequest;
use App\Http\Requests\StudentClass\UpdateStudentClassRequest;

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
                        if($class->getTeacher->status != User::USER_STATUS_ACTIVE || $class->getTeacher->account_type != User::ACCOUNT_TYPE_TEACHER)
                        {
                            return 'Guru sudah tidak aktif';
                        }
                        else
                        {
                            return $class->getTeacher->full_name;
                        }
                    }) 
                    ->rawColumns(['action'])
                    ->toJson();
        }

        $data_guru = User::getTeacher();
        
        $guru_option = '<select class="js-example-basic-single form-control" name="teacher_id" id="guru" style="width: 100%">';
            foreach ($data_guru as $guru) {
                $guru_option .= '<option value="'.$guru->id.'">'.$guru->full_name.'</option>';
            }
        $guru_option .= '</select>';

        $years = array_combine(range(date("Y"), 2001), range(date("Y"), 2001));

        if($this->getUserPermission('index class'))
        {
            return view('student_class.index', ['active'=>'student_class','years'=>$years,'guru_option'=>$guru_option]);
        }
        else
        {
            return view('error.unauthorized', ['active'=>'student_class']);
        }
    }

    /**
     * @return void
     */
    public function create()
    {
        if($this->getUserPermission('create class'))
        {
            $years = array_combine(range(date("Y"), 2001), range(date("Y"), 2001));
            return view('student_class.store', ['active'=>'student_class','years'=>$years]);
        }
        else
        {
            return view('error.unauthorized', ['active'=>'student_class']);
        }
    }

    /**
     * @return void
     */
    public function update(UpdateStudentClassRequest $request)
    {
        if ($request->ajax()) {

            DB::beginTransaction();

            $student_class = StudentClass::findOrFail($request->get('idclass'));
            $student_class->angkatan = $request->get('angkatan');
            $student_class->class_name = $request->get('class_name');
            $student_class->note = $request->get('note');
            $student_class->teacher_id = $request->get('teacher_id');

            if(!$student_class->save())
            {
                DB::rollBack();
                return $this->getResponse(false,400,'','Kelas gagal diupdate');
            }

            if($this->getUserPermission('update class'))
            {
                DB::commit();
                return $this->getResponse(true,200,'','Kelas berhasil diupdate');
            }
            else
            {
                DB::rollBack();
                return $this->getResponse(false,505,'','Tidak mempunyai izin untuk aktifitas ini');
            }
        }
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

        if($this->getUserPermission('create class'))
        {
            DB::commit();
            return redirect('student-class')->with('alert_success', 'Berhasil Disimpan');
        }
        else
        {
            DB::rollBack();
            return $this->getResponse(false,505,'','Tidak mempunyai izin untuk aktifitas ini');
        }
    }

     /**
     * @return void
     */
    public function getUserTeacher(Request $request)
    {
        if ($request->ajax()) {

            if($request->has('search')){
                $data_guru = User::getTeacher($request->get('search'));
            }
            else
            {
                $data_guru = User::getTeacher();
            }

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

    /**
     *
     */
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $student_class = StudentClass::findOrFail($request->get('idclass'));
            return new StudentClassResource($student_class);
        }
    }

    /**
     *
     */
    public function delete(Request $request)
    {
        if ($request->ajax()) {

            DB::beginTransaction();
            $classModel = StudentClass::findOrFail($request->idclass);

            if(!$classModel->delete())
            {
                DB::rollBack();
                return $this->getResponse(false,400,'','Kelas gagal dihapus');
            }

            DB::commit();
            return $this->getResponse(true,200,'','Kelas berhasil dihapus');
        }
    }

    // ------------------------------ Aditional Function -------------------
   
    
}
