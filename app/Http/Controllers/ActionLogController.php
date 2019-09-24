<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use App\Model\ActionLog\ActionLog;

use DB;

class ActionLogController extends Controller
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

            $data = ActionLog::all();
            return Datatables::of($data)
            		->addColumn('user', function($row) {
						return $row->getUser->full_name;
					})
                    ->addIndexColumn()
                    ->make(true);
        }

        if($this->getUserPermission('index role'))
        {
            $this->systemLog(false,'Mengakses halaman action log');
            return view('action-log.index', ['active'=>'action-log']);
        }
        else
        {
            $this->systemLog(true,'Gagal Mengakses halaman action log');
            return view('error.unauthorized', ['active'=>'action-log']);
        }
    }

    public function destroy(Request $request)
    {
        if ($request->ajax()) {

            if(ActionLog::truncate())
            {
                return $this->getResponse(true,200,'','Semua data log berhasil terhapus');
            }
            else
            {
                return $this->getResponse(false,400,'','Terjadi kesalahan, Data gagal dihapus');
            }
        }
    }
}
