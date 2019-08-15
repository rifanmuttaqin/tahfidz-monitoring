<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\User\PasswordRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\StoreUserRequest;

use Yajra\Datatables\Datatables;

use App\Model\User\User;

use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserCollection;

use Illuminate\Support\Facades\Hash;

use DB;

class UserController extends Controller
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

            $data = User::getUser();
           
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

        return view('user.index', ['active'=>'user']);
    }

    /**
     * @return void
     */
    public function create()
    {
        return view('user.store', ['active'=>'user']);
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
        $user->account_type = $request->get('account_type');
        $user->status = User::USER_STATUS_ACTIVE;

        if(!$user->save())
        {
            DB::rollBack();
            return redirect('user')->with('alert_error', 'Gagal Disimpan');
        }

        DB::commit();
        return redirect('user')->with('alert_success', 'Berhasil Disimpan');
    }

    /**
     * @return void
     */
    public function delete(Request $request)
    {
        if ($request->ajax()) {

            DB::beginTransaction();
            $userModel = User::findOrFail($request->iduser);
            $userModel->status = User::USER_STATUS_NOT_ACTIVE;

            if(!$userModel->save())
            {
                DB::rollBack();
                return $this->getResponse(false,400,'','User gagal dinonaktifkan');
            }

            DB::commit();
            return $this->getResponse(true,200,'','User berhasil dinonaktifkan');
        }
    }

    /**
     * @return void
     */
    public function show(Request $request)
    {
        if ($request->ajax()) {

            if($request->iduser != null)
            {
                $user_id = $request->iduser;
                $userModel = User::findOrFail($user_id);

                return new UserResource($userModel);
            }
            else
            {
                return $this->getResponse(false,500,'','Akses gagal dilakukan');
            }
        }
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
            $user->account_type = $request->get('account_type');
                        
            if(!$user->save())
            {
                DB::rollBack();
                return $this->getResponse(true,400,null,'User gagal diupdate');
            }

            DB::commit();
            return $this->getResponse(true,200,'','User berhasil diupdate');
        }
    }

    /**
     * @return void
     */
    public function updatePassword(PasswordRequest $request)
    {
        if ($request->ajax()) {

            DB::beginTransaction();

            $user = User::findOrFail($request->iduser);
            $user->password = Hash::make($request->password);

            if(!$user->save())
            {
                DB::rollBack();
                return $this->getResponse(true,400,null,'Password gagal diupdate');
            }

            DB::commit();
            return $this->getResponse(true,200,'','Password berhasil diupdate');   
        }
    }

    // ------------------------------ Aditional Function -------------------

}
