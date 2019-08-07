<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use App\Model\User\User;

class UserController extends Controller
{
    private $request;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');

        $this->request = $request;
        $this->user = $request->auth;
    }

    /**
     * Show the application index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if ($this->request->ajax()) {

            $data = User::all();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){  
                        $btn = '<button onclick="btnUbah('.$row->id.')" name="btnUbah" type="button" class="btn btn-info">DETAIL</button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('user.index', ['active'=>'user']);
    }

    /**
     * @return void
     */
    public function show()
    {
        if ($this->request->ajax()) {

            if($this->request->iduser != null)
            {
                $user_id = $this->request->iduser;
                $userModel = User::findOrFail($user_id);

                // Need Resource

                return $this->getResponse(true,200,$userModel,'Akses Berhasil');
            }
            else
            {
                return $this->getResponse(false,500,'','Akses gagal dilakukan');
            }
        }
    }

    /**
    * Process datatables ajax request.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function anyData()
    {
        return Datatables::of(User::query())->make(true);
    }

}
