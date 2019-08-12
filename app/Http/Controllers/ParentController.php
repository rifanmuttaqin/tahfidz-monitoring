<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use App\Model\User\User;

use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserCollection;

use App\Http\Requests\User\PasswordRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\StoreUserRequest;

use Illuminate\Support\Facades\Hash;

use DB;

class ParentController extends Controller
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

            $data = User::getParent();
           
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){  
                        $btn = '<button onclick="btnUbah('.$row->id.')" name="btnUbah" type="button" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span></button>';
                        $pass = '<button onclick="btnPass('.$row->id.')" name="btnPass" type="button" class="btn btn-info"><span class="glyphicon glyphicon-cog"></span></button>';
                        $delete = '<button onclick="btnDel('.$row->id.')" name="btnDel" type="button" class="btn btn-info"><span class="glyphicon glyphicon-trash"></span></button>';
                        return $btn .'&nbsp'. $pass .'&nbsp'. $delete; 
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('parent.index', ['active'=>'parent']);
    }

    /**
     * @return void
     */
    public function create()
    {
        return view('parent.store', ['active'=>'parent']);
    }

     /**
     * @return void
     */
    public function update(UpdateUserRequest $request)
    {
        if ($request->ajax()) {

            DB::beginTransaction();

            $user = User::findOrFail($request->iduser);

            $user->username = $request->get('username');
            $user->email = $request->get('email');
            $user->address = $request->get('address');
            $user->full_name = $request->get('full_name');
            $user->account_type = User::ACCOUNT_TYPE_PARENT;
                        
            if(!$user->save())
            {
                DB::rollBack();
                return $this->getResponse(true,400,null,'Data gagal diupdate');
            }

            DB::commit();
            return $this->getResponse(true,200,'','Data berhasil diupdate');
        }
    }

    /**
     * @return void
     */
    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();
        
        $user = new User();

        $user->username = $request->get('username');
        $user->email = $request->get('email');
        $user->address = $request->get('address');
        $user->full_name = $request->get('full_name');
        $user->password = Hash::make($request->get('password'));
        $user->status = $request->get('status');
        $user->account_type = User::ACCOUNT_TYPE_PARENT;
        $user->status = User::USER_STATUS_ACTIVE;

        if(!$user->save())
        {
            DB::rollBack();
            return redirect('parent')->with('alert_error', 'Gagal Disimpan');
        }

        DB::commit();
        return redirect('parent')->with('alert_success', 'Berhasil Disimpan');
    }

}
