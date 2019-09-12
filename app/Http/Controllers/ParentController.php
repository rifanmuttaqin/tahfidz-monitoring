<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use App\Model\User\User;

use App\Model\SiswaHasParent\SiswaHasParent;


use App\Model\Siswa\Siswa;

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

        $data_siswa = Siswa::getAll();
        
        $siswa_option = '<select class="js-example-basic-single form-control" name="siswa_data[]" id="siswa_data" style="width: 100%" multiple="multiple">';
            foreach ($data_siswa as $siswa) {
                $siswa_option .= '<option value="'.$siswa->id.'">'.$siswa->siswa_name.'</option>';
            }

        $siswa_option .= '</select>';
        
        if($this->getUserPermission('index parent'))
        {
            $this->systemLog(false,'Mengakses Halaman Orangtua');
            return view('parent.index', ['active'=>'parent', 'siswa_option'=>$siswa_option]);
        }
        else
        {
            return view('error.unauthorized', ['active'=>'parent']);
        }
    }

    /**
     * @return void
     */
    public function create()
    {
        if($this->getUserPermission('create parent'))
        {
            $this->systemLog(false,'Mengakses Halaman Penambahan Orangtua');
            return view('parent.store', ['active'=>'parent']);
        }
        else
        {
            return view('error.unauthorized', ['active'=>'parent']);
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
            $user->account_type = User::ACCOUNT_TYPE_PARENT;
                        
            if(!$user->save())
            {
                $this->systemLog(true,'Gagal Mengupdate Orangtua');
                DB::rollBack();
                return $this->getResponse(true,400,null,'Data gagal diupdate');
            }

            if($siswa_data = $request->get('siswa_data'))
            {
                if($old_data_siswa = SiswaHasParent::getByParent($user->id))
                {
                    foreach ($old_data_siswa as $old) 
                    {
                        if(!$old->delete())
                        {
                            DB::rollBack();
                            return redirect('parent')->with('alert_error', 'Gagal Disimpan 1');
                        }
                    }
                }
                
                foreach ($siswa_data as $siswa) {
                    $siswa_has_parent = new SiswaHasParent();
                    $siswa_has_parent->parent_id = $user->id;
                    $siswa_has_parent->siswa_id = $siswa;

                    if(SiswaHasParent::validateSiswaParent($user->id,$siswa))
                    {
                        DB::rollBack();
                        return redirect('parent')->with('alert_error', 'Gagal Disimpan 2');
                    }

                    if(!$siswa_has_parent->save())
                    {
                        DB::rollBack();
                        return redirect('parent')->with('alert_error', 'Gagal Disimpan 3');
                    }
                }
            }

            if($this->getUserPermission('update parent'))
            {
                $this->systemLog(false,'Mengupdate Orangtua');
                DB::commit();
                return $this->getResponse(true,200,'','Data berhasil diupdate');
            }
            else
            {
                $this->systemLog(true,'Gagal Mengupdate Orangtua');
                return $this->getResponse(false,505,'','Tidak mempunyai izin untuk aktifitas ini');
            }   
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
            $this->systemLog(true,'Gagal store Orangtua');
            DB::rollBack();
            return redirect('parent')->with('alert_error', 'Gagal Disimpan');
        }

        if($siswa_data = $request->get('siswa_data'))
        {
            foreach ($siswa_data as $siswa) {
                $siswa_has_parent = new SiswaHasParent();
                $siswa_has_parent->parent_id = $user->id;
                $siswa_has_parent->siswa_id = $siswa;

                if(SiswaHasParent::validateSiswaParent($user->id,$siswa))
                {
                    $this->systemLog(true,'Gagal store Orangtua');
                    DB::rollBack();
                    return redirect('parent')->with('alert_error', 'Gagal Disimpan 1');
                }

                if(!$siswa_has_parent->save())
                {
                    $this->systemLog(true,'Gagal store Orangtua');
                    DB::rollBack();
                    return redirect('parent')->with('alert_error', 'Gagal Disimpan 2');
                }
            }
        }
        
        if($this->getUserPermission('create parent'))
        {
            $this->systemLog(false,'Berhasil Store Orangtua');
            DB::commit();
            return redirect('parent')->with('alert_success', 'Berhasil Disimpan');
        }
        else
        {
            $this->systemLog(true,'Gagal store Orangtua');
            return $this->getResponse(false,505,'','Tidak mempunyai izin untuk aktifitas ini');
        }
    }

    /**
     * @return void
     */
    public function getSiswa(Request $request)
    {
        if ($request->ajax()) {

            if($request->has('search')){
                $data_siswa = Siswa::getAll($request->get('search'));
            }
            else
            {
                $data_siswa = Siswa::getAll();
            }

            $arr_data  = array();
            
            if($data_siswa)
            {
                $key = 0;

                foreach ($data_siswa as $data) {
                    $arr_data[$key]['id'] = $data->id;
                    $arr_data[$key]['text'] = $data->siswa_name;
                    $key++;
                }
            }

            return json_encode($arr_data);
        }
    }

}
