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

        return view('iqro.index', ['active'=>'iqro']);
    }

     /**
     * @return void
     */
    public function create()
    {
        return view('iqro.store', ['active'=>'iqro']);
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

        DB::commit();
        return redirect('iqro')->with('alert_success', 'Berhasil Disimpan');
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
                DB::rollBack();
                return $this->getResponse(false,400,'','Iqro gagal dihapus');
            }

            DB::commit();
            return $this->getResponse(true,200,'','Iqro berhasil dihapus');
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
            DB::rollBack();
            return $this->getResponse(false,400,'','Iqro gagal diupdate');
        }

        DB::commit();
        return $this->getResponse(true,200,'','Iqro berhasil diupdate');
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
