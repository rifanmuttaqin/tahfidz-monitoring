<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use App\Model\Siswa\Siswa;
use App\Model\StudentClass\StudentClass;
use App\Model\User\User;

use App\Http\Requests\Siswa\StoreSiswaRequest;
use App\Http\Requests\Siswa\UpdateSiswaRequest;


use App\Http\Resources\Siswa\SiswaResource;

use DB;

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
			    ->addColumn('memorization_type', function(Siswa $value) {
			        return Siswa::getHafalanMeaning($value->memorization_type);
			    })
			    ->addColumn('class_id', function(Siswa $class) {
			        return $class->getClass->class_name.' ('.$class->getClass->angkatan.')';
			    })
			    ->rawColumns(['action'])
			    ->toJson();
        }

        $data_kelas = StudentClass::getClass();
        
        $class_option = '<select class="js-example-basic-single form-control" name="class_id" id="class_id" style="width: 100%">';
            foreach ($data_kelas as $class) {
                $class_option .= '<option value="'.$class->id.'">'.$class->class_name.' ('.$class->angkatan.') </option>';
            }
        $class_option .= '</select>';

        if($this->getUserPermission('index siswa'))
        {
            return view('siswa.index', ['active'=>'siswa','class_option'=>$class_option]);
        }
        else
        {
            return view('error.unauthorized', ['active'=>'siswa']);
        }
    }

    /**
     * @return void
     */
    public function create()
    {
        if($this->getUserPermission('create siswa'))
        {
            return view('siswa.store', ['active'=>'siswa']);
        }
        else
        {
            return view('error.unauthorized', ['active'=>'siswa']);
        }
    }

    /**
     * @return void
     */
    public function update(UpdateSiswaRequest $request)
    {
        DB::beginTransaction();

        $siswa = Siswa::findOrFail($request->get('idsiswa'));

        $siswa->siswa_name = $request->get('siswa_name');
        $siswa->memorization_type = $request->get('memorization_type');
        $siswa->class_id = $request->get('class_id');
    
        // Validasi jika siswa ini belum pernah diinput sebelumnya
        if(Siswa::validateSiswa($request->get('class_id'),$request->get('siswa_name'),$request->get('idsiswa')))
        {
            DB::rollBack();
            return $this->getResponse(false,400,'','Data siswa ini sudah terinput sebelumnya');
        }

        if(!$siswa->save())
        {
            DB::rollBack();
            return $this->getResponse(false,400,'','Siswa gagal diupdate');
        }

        if($this->getUserPermission('update siswa'))
        {
            DB::commit();
            return $this->getResponse(true,200,'','Siswa berhasil diupdate');
        }
        else
        {
            DB::rollBack();
            return view('error.unauthorized', ['active'=>'siswa']);
        }
    }

    /**
     * @return void
     */
    public function store(StoreSiswaRequest $request)
    {
    	DB::beginTransaction();

    	$siswa = new Siswa();

    	$siswa->siswa_name = $request->get('siswa_name');
    	$siswa->memorization_type = $request->get('memorization_type');
    	$siswa->class_id = $request->get('class_id');
    	
    	// Validasi jika siswa ini belum pernah diinput sebelumnya
    	if(Siswa::validateSiswa($request->get('class_id'),$request->get('siswa_name')))
    	{
    		DB::rollBack();
	    	return redirect('siswa')->with('alert_error', 'Data siswa telah dimasukkan sebelumnya');
    	}

    	if(!$siswa->save())
        {
            DB::rollBack();
            return redirect('siswa')->with('alert_error', 'Gagal Disimpan');
        }

        if($this->getUserPermission('create siswa'))
        {
            DB::commit();
            return redirect('siswa')->with('alert_success', 'Berhasil Disimpan');
        }
        else
        {
            DB::rollBack();
            return view('error.unauthorized', ['active'=>'siswa']);
        }
    }

     /**
     *
     */
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $siswa = Siswa::findOrFail($request->get('idsiswa'));
            return new SiswaResource($siswa);
        }
    }

    
    /**
     * @return void
     */
    public function getClass(Request $request)
    {
    	if ($request->ajax()) {
			if($request->has('search'))
			{
			    $data_class = StudentClass::getClass($request->get('search'));
			}
			else
			{
			    $data_class = StudentClass::getClass();
			}

			$arr_data  = array();

			if($data_class)
			{
			    $key = 0;

			    foreach ($data_class as $data) {
			        $arr_data[$key]['id'] = $data->id;
			        $arr_data[$key]['text'] = $data->class_name .' ('.$data->angkatan.')';
			        $key++;
			    }
			}

			return json_encode($arr_data);
    	}
    }

    /**
     * @return void
     */
    public function delete(Request $request)
    {
    	if ($request->ajax()) {

    		DB::beginTransaction();
            $siswaModel = Siswa::findOrFail($request->idsiswa);

            if(!$siswaModel->delete())
            {
                DB::rollBack();
                return $this->getResponse(false,400,'','Siswa gagal dihapus');
            }

            DB::commit();
            return $this->getResponse(true,200,'','Siswa berhasil dihapus');
    	}
    }
}
