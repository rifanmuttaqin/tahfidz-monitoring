<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use App\Model\Siswa\Siswa;

class SiswaController extends Controller
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
			        $btn = '<button onclick="btnUbah('.$row->id.')" name="btnUbah" type="button" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span></button>';
			        $delete = '<button onclick="btnDel('.$row->id.')" name="btnDel" type="button" class="btn btn-info"><span class="glyphicon glyphicon-trash"></span></button>';
			        return $btn .'&nbsp'. $delete; 
			    })
			    ->addColumn('class_id', function(StudentClass $class) {
			        return $class->getClass->full_name;
			    })
			    ->addColumn('parent_id', function(StudentClass $class) {
			        return $class->getParent->full_name;
			    }) 
			    ->rawColumns(['action'])
			    ->toJson();
        }

        return view('siswa.index', ['active'=>'siswa']);
    }

    /**
     * @return void
     */
    public function create()
    {
        return view('siswa.store', ['active'=>'siswa']);
    }
}
