<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;

use App\Model\Helper\Role;
use App\Model\Helper\Permission;

use App\Model\RoleHasPermission\RoleHasPermission;

use DB;

class RoleController extends Controller
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

            $data = Role::whereNotIn('name', ['Creator'])->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){  
                        $btn = '<button onclick="btnUbah('.$row->id.')" name="btnUbah" type="button" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span></button>';
                        $delete = '<button onclick="btnDel('.$row->id.')" name="btnDel" type="button" class="btn btn-info"><span class="glyphicon glyphicon-trash"></span></button>';
                        return $btn; 
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        if($this->getUserPermission('index role'))
        {
            $this->systemLog(false,'Mengakses halaman role');
            return view('role.index', ['active'=>'role']);
        }
        else
        {
            $this->systemLog(true,'Gagal Mengakses halaman role');
            return view('error.unauthorized', ['active'=>'role']);
        }
    }

    /**
     * @return void
     */
    public function create()
    {
        $this->systemLog(false,'Mengakses halaman create role');
        $data_permission = Permission::all();
        return view('role.store', ['active'=>'role','data_permission'=>$data_permission]);
    }


    /**
     * @return void
     */
    public function edit($id)
    {
        if($this->getUserPermission('update role'))
        {
            $role = Role::findOrFail($id);
            $data_role_permission = RoleHasPermission::getHasPermission($id);
            $arr_permission = [];

            foreach ($data_role_permission as $val) 
            {
                array_push($arr_permission, $val->permission_id);
            }

            $data_permission = Permission::all();

            $this->systemLog(false,'Mengakses halaman update role');

            return view('role.update', [
                'active'=>'role','data'=>$role, 
                'data_role_permission'=>$arr_permission,
                'data_permission'=>$data_permission,
                'id' => $id
            ]);
        }
        else
        {
            $this->systemLog(true,'Gagal Mengakses halaman update role');
            return view('error.unauthorized', ['active'=>'role']);
        }
    }

    /**
     * @return void
     */
    public function update(UpdateRoleRequest $request,$role_id)
    {
        DB::beginTransaction();

        $role = Role::findOrFail($role_id);

        if($role)
        {
            if($permissions = $request->get('permission'))
            {
                // revoke first before assign new permission to role
                $permission_role = $role->permissions()->get();

                foreach ($permission_role as $delete_permission) 
                {
                    $role->revokePermissionTo($delete_permission->name);
                }
                
                foreach ($permissions as $permission_assign) 
                {
                    $data = Permission::findOrFail($permission_assign);
                    $role->givePermissionTo($data->name);
                }

                if($this->getUserPermission('update role'))
                {
                    $this->systemLog(false,'Berhasil melakukan update data');
                    DB::commit();
                    return redirect('role')->with('alert_success', 'Konfigurasi baru pada role berhasil dibuat');
                }
                else
                {
                    $this->systemLog(true,'gagal mengupdate role');
                    DB::rollBack();
                    return view('error.unauthorized', ['active'=>'role']);
                }
            }
        }
        else
        {
            $this->systemLog(true,'gagal mengupdate role');
            DB::rollBack();
            return redirect('role')->with('alert_error', 'Gagal Disimpan');
        }
    }

    /**
     * @return void
     */
    public function store(StoreRoleRequest $request)
    {
        DB::beginTransaction();

        $role = Role::create(['name' => $request->get('name')]);

        if($role)
        {
            if($permissions = $request->get('permission'))
            {
                foreach ($permissions as $permission) {
                    
                    $data = Permission::findOrFail($permission);
                    $role->givePermissionTo($data->name);
                }

                $this->systemLog(false,'berhasil membuat role');
                DB::commit();
                return redirect('role')->with('alert_success', 'Role berhasil dikonfigurasi');
            }
        }
        else
        {
            DB::rollBack();
            return redirect('role')->with('alert_error', 'Gagal Disimpan');
        }
    }

    /**
     * @return void
     */
    public function delete(Request $request)
    {
        if ($request->ajax()) 
        {
            DB::beginTransaction();

            $role = Role::findOrFail($request->get('idrole'));

            $permissions = $role->permissions;

            foreach ($permissions as $permission) 
            {
                $role->revokePermissionTo($permission->name);
            }

            if($role->delete())
            {
                $this->systemLog(false,'berhasil menghapus role');
                DB::commit();
                return $this->getResponse(true,200,'','Role berhasil dihapus');
            }
                     
        }
    }
}
