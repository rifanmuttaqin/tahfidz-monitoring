<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables;

use Illuminate\Http\Request;

use App\Model\Iqro\Iqro;

use App\Http\Requests\Iqro\StoreIqroRequest;
use App\Http\Requests\Iqro\UpdateIqroRequest;

use App\Http\Resources\Iqro\IqroResource;

use DB;

class IqroController extends Controller
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

            $data = Iqro::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){  
                        $btn = '<button onclick="btnUbah('.$row->id.')" name="btnUbah" type="button" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span></button>';
                        $delete = '<button onclick="btnDel('.$row->id.')" name="btnDel" type="button" class="btn btn-info"><span class="glyphicon glyphicon-trash"></span></button>';
                        return $btn .'&nbsp'.'&nbsp'. $delete; 
                    })
					->addColumn('jilid_number', function($row) {
						return 'JILID '.$row->jilid_number;
					})
                    ->rawColumns(['action'])
                    ->make(true);
        }

        if($this->getUserPermission('index iqro'))
        {
            $this->systemLog(false,'Mengakses Halaman Master Iqro');
            return view('iqro.index', ['active'=>'iqro']);
        }
        else
        {
            $this->systemLog(true,'Gagal Mengakses Halaman Master Iqro');
            return view('error.unauthorized', ['active'=>'iqro']);
        }   
    }

     /**
     * @return void
     */
    public function create()
    {
        if($this->getUserPermission('create iqro'))
        {
            $this->systemLog(false,'Mengakses Halaman Create Iqro');
            return view('iqro.store', ['active'=>'iqro']);
        }
        else
        {
            $this->systemLog(true,'Gagal Mengakses Halaman Create Iqro');
            return view('error.unauthorized', ['active'=>'iqro']);
        }
    }

    /**
     * @return void
     */
    public function store(StoreIqroRequest $request)
    {
        DB::beginTransaction();
   
        $iqro = new Iqro();

       	$iqro->jilid_number = $request->get('jilid_number');
       	$iqro->total_page = $request->get('total_page');

       	if(!$iqro->save())
        {
            DB::rollBack();
            return redirect('iqro')->with('alert_error', 'Gagal Disimpan');
        }

        if($this->getUserPermission('create iqro'))
        {
            $this->systemLog(false,'Berhasil menyimpan data Iqro JILID : '.$iqro->jilid_number.' ');
            DB::commit();
            return redirect('iqro')->with('alert_success', 'Berhasil Disimpan');
        }
        else
        {
            $this->systemLog(true,'Gagal Membuat Iqro');
            DB::rollBack();
            return view('error.unauthorized', ['active'=>'iqro']);
        }
    }

    /**
     * @return void
     */
    public function delete(Request $request)
    {
    	if ($request->ajax()) {

    		DB::beginTransaction();
            $iqroModel = Iqro::findOrFail($request->idiqro);

            if(!$iqroModel->delete())
            {
                $this->systemLog(true,'Gagal Mendelete Iqro');
                DB::rollBack();
                return $this->getResponse(false,400,'','Iqro gagal dihapus');
            }

            if($this->getUserPermission('create iqro'))
            {
                $this->systemLog(false,'Berhasil Mendelete Iqro');
                DB::commit();
                return $this->getResponse(true,200,'','Iqro berhasil dihapus');
            }
            else
            {
                return $this->getResponse(false,505,'','Tidak mempunyai izin untuk aktifitas ini');
            }
    	}
    }

    /**
     * @return void
     */
    public function update(UpdateIqroRequest $request)
    {
        DB::beginTransaction();

        $iqro = Iqro::findOrFail($request->get('idiqro'));

       	$iqro->jilid_number = $request->get('jilid_number');
       	$iqro->total_page = $request->get('total_page');

        if(!$iqro->save())
        {
            $this->systemLog(true,'Gagal Mengupdate Iqro');
            DB::rollBack();
            return $this->getResponse(false,400,'','Iqro gagal diupdate');
        }

        if($this->getUserPermission('update iqro'))
        {
            $this->systemLog(false,'Berhasil Mengupdate Iqro');
            DB::commit();
            return $this->getResponse(true,200,'','Iqro berhasil diupdate');
        }
        else
        {
            return $this->getResponse(false,505,'','Tidak mempunyai izin untuk aktifitas ini');   
        }   
    }

    /**
     *
     */
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $iqro = Iqro::findOrFail($request->get('idiqro'));
            return new IqroResource($iqro);
        }
    }

}
