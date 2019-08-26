<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Surah\Surah;

use App\Http\Requests\Surah\StoreSurahRequest;
use App\Http\Requests\Surah\UpdateSurahRequest;

use Yajra\Datatables\Datatables;

use App\Http\Resources\Surah\SurahResource;

use DB;

class AlquranController extends Controller
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

            $data = Surah::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){  
                        $btn = '<button onclick="btnUbah('.$row->id.')" name="btnUbah" type="button" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span></button>';
                        $delete = '<button onclick="btnDel('.$row->id.')" name="btnDel" type="button" class="btn btn-info"><span class="glyphicon glyphicon-trash"></span></button>';
                        return $btn .'&nbsp'.'&nbsp'. $delete; 
                    })
					->addColumn('surah_name', function($row) {
						return 'Surat '.$row->surah_name;
					})
                    ->rawColumns(['action'])
                    ->make(true);
        }

        if($this->getUserPermission('index surah'))
        {
            return view('alquran.index', ['active'=>'alquran']);
        }
        else
        {
            return view('error.unauthorized', ['active'=>'alquran']);
        }
    }

    /**
     * @return void
     */
    public function create()
    {
        if($this->getUserPermission('create surah'))
        {
            return view('alquran.store', ['active'=>'alquran']);
        }
        else
        {
            return view('error.unauthorized', ['active'=>'alquran']);
        }
    }

    /**
     * @return void
     */
    public function store(StoreSurahRequest $request)
    {
        DB::beginTransaction();
   
        $surah = new Surah();

       	$surah->juz = $request->get('juz');
       	$surah->surah_name = $request->get('surah_name');
       	$surah->total_ayat = $request->get('total_ayat');

       	if(!$surah->save())
        {
            DB::rollBack();
            return redirect('alquran')->with('alert_error', 'Gagal Disimpan');
        }

        if($this->getUserPermission('create surah'))
        {
             DB::commit();
            return redirect('alquran')->with('alert_success', 'Berhasil Disimpan');
        }
        else
        {
            DB::rollBack();
            return redirect('alquran')->with('alert_error', 'Gagal Disimpan');
        }
    }

    /**
     * @return void
     */
    public function update(UpdateSurahRequest $request)
    {
        DB::beginTransaction();

        $surah = Surah::findOrFail($request->get('idsurah'));

       	$surah->juz = $request->get('juz');
       	$surah->surah_name = $request->get('surah_name');
       	$surah->total_ayat = $request->get('total_ayat');

        if(!$surah->save())
        {
            DB::rollBack();
            return $this->getResponse(false,400,'','Surah gagal diupdate');
        }

        if($this->getUserPermission('update surah'))
        {
            DB::commit();
            return $this->getResponse(true,200,'','Surah berhasil diupdate');
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
    public function delete(Request $request)
    {
    	if ($request->ajax()) {

    		DB::beginTransaction();
            $alquranModel = Surah::findOrFail($request->idsurah);

            if(!$alquranModel->delete())
            {
                DB::rollBack();
                return $this->getResponse(false,400,'','Surah gagal dihapus');
            }

            if($this->getUserPermission('delete surah'))
            {
                DB::commit();
                return $this->getResponse(true,200,'','Surah berhasil dihapus');
            }
            else
            {
                DB::rollBack();
                return $this->getResponse(false,505,'','Tidak mempunyai izin untuk aktifitas ini');
            }
    	}
    }


    /**
     *
     */
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $alquran = Surah::findOrFail($request->get('idsurah'));
            return new SurahResource($alquran);
        }
    }


}
