<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;

use App\Model\Helper\Role;
use App\Model\Helper\Permission;

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

            $data = Role::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){  
                        $btn = '<button onclick="btnUbah('.$row->id.')" name="btnUbah" type="button" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span></button>';
                        $delete = '<button onclick="btnDel('.$row->id.')" name="btnDel" type="button" class="btn btn-info"><span class="glyphicon glyphicon-trash"></span></button>';
                        return $btn .'&nbsp'.'&nbsp'. $delete; 
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('role.index', ['active'=>'role']);
    }

    /**
     * @return void
     */
    public function create()
    {
        $data_permission = Permission::all();
        return view('role.store', ['active'=>'role','data_permission'=>$data_permission]);
    }


    /**
     * @return void
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $data_permission = Permission::all();
        return view('role.update', ['active'=>'role','data'=>$role, 'data_permission'=>$data_permission]);
    }

    /**
     * @return void
     */
    public function update(UpdateRoleRequest $request)
    {

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
                DB::commit();
                return $this->getResponse(true,200,'','Role berhasil dihapus');
            }
                     
        }
    }
}
