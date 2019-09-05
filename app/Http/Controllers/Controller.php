<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Model\ActionLog\ActionLog;

use Auth;

use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getUserLogin()
    {
        $user = Auth::user();
        return $user;
    }

    /**
     * @return void
     */
    public function getResponse($status,$status_code,$data=null,$message)
    {
        if($status != false)
        {
            return response()->json(['status'=> $status, 'status_code'=> $status_code, 'data'=>$data, 'message'=>$message]); 
        }
        else
        {
            return response()->json(['status'=> $status, 'status_code'=> $status_code, 'data'=>$data, 'message'=>$message]);  
        }
    }

    /**
     * Untuk mengontrol permission 
     */
    public function getUserPermission($permission_name)
    {
        $user = Auth::user();

        if(!$user->hasPermissionTo($permission_name))
        {
            return false;
        }

        return true;
    }

    /**
     * @return void
     */
    public function systemLog($is_error = false, $action_message='')
    {
        $user = Auth::user();

        DB::beginTransaction();

        $action_log = new ActionLog();
        $action_log->action_type = ActionLog::TYPE_GENERAL;
        $action_log->is_error = $is_error;
        $action_log->action_message = $action_message;
        $action_log->user_id = $user->id;
        $action_log->date = date('Y-m-d H:i:s');

        if(!$action_log->save())
        {
            DB::rollBack();
            return false;
        }

        DB::commit();
        return true;
    }

    
    /**
     * @return void
     */
    public function printLog()
    {

    }

}
