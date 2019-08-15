<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Profile\PasswordRequest;

use App\Http\Requests\User\UpdateUserRequest;

use App\Http\Requests\Profile\ProfileRequest;

use App\Model\User\User;

use App\Http\Resources\User\UserResource;

use Illuminate\Support\Facades\Hash;

use Auth;

use App\Http\Requests\User\StoreUserRequest;

use DB;

class ProfileController extends Controller
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
    	$data_user = Auth::user();
    	return view('profile.index', ['active'=>'profile', 'data_user'=>$data_user]);
    }

    /**
     * @return void
     */
    public function update(ProfileRequest $request)
    {
		DB::beginTransaction();

		$user = User::findOrFail(Auth::user()->id);

		$user->email = $request->get('email');
		$user->address = $request->get('address');
		$user->full_name = $request->get('full_name');
		$user->account_type = $user->account_type;
		            
		if(!$user->save())
		{
		    DB::rollBack();
		    return redirect('profile')->with('alert_error', 'Berhasil Disimpan');
		}

		DB::commit();
		return redirect('profile')->with('alert_success', 'Berhasil Disimpan');
    }

    /**
     * @return void
     */
    public function updatePassword(PasswordRequest $request)
    {
        if ($request->ajax()) {

            DB::beginTransaction();

            if(User::passwordChangeValidation($request->get('old_password'),Auth::user()->password))
            {
                $user = User::findOrFail(Auth::user()->id);
                $user->password = Hash::make($request->get('password'));

                if(!$user->save())
                {
                    DB::rollBack();
                    return $this->getResponse(false,400,null,'Password gagal diupdate');
                }

                DB::commit();
                return $this->getResponse(true,200,'','Password berhasil diupdate'); 
            }

            DB::rollBack();
            return $this->getResponse(false,400,null,'Password lama yang anda masukkan tidak sesuai');
        }
    }

}
