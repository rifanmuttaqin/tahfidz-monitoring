<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables;

use App\Model\Notification\Notification;
use App\Model\UserNotification\UserNotification;

use App\Model\ActionLog\ActionLog;

use App\Model\User\User;

use App\Http\Resources\Notification\NotificationResource;
use App\Http\Requests\Notification\StoreNotificationRequest;


use Auth;

use DB;

use Carbon\Carbon;

use Illuminate\Http\Request;

class NotificationController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Notification::orderBy('created_at','DESC')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('notification_type', function(Notification $value) {
                        return Notification::getTypeMeaning($value->notification_type);
                    })
                    ->addColumn('date', function(Notification $value) {
                        $date =  Carbon::parse($value->date);
                        return $date->format('d M Y');
                    })
            ->make(true);
        }

        if($this->getUserPermission('index notification'))
        {
            $this->systemLog(false,'Mengakses Halaman Notifikasi');
            return view('notification.index', ['active'=>'notification']);
        }
        else
        {
            $this->systemLog(true,'Gagal Mengakses Halaman Notification');
            return view('error.unauthorized', ['active'=>'notification']);
        }
    }


    public function getDetail(Request $request)
    {
        if ($request->ajax()) {

            $user_notification = UserNotification::where('user_id', Auth::user()->id)->where('notification_id',$request->get('idnotification'))->where('status',UserNotification::STATUS_UNREAD)->first();

            if($user_notification != null)
            {
                $user_notification->status = UserNotification::STATUS_READ;
                $user_notification->save();
            }

            $notification = Notification::findOrFail($request->get('idnotification'));
            return new NotificationResource($notification);
        }
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotificationRequest $request)
    {
        DB::beginTransaction();

        $notification = new Notification();

        $notification->notification_type    = $request->get('notification_type');
        $notification->notification_title   = $request->get('notification_title');
        $notification->notification_message = $request->get('notification_message');
        
        $notification->date = Carbon::now();

        if(!$notification->save())
        {
            DB::rollBack();
            $this->systemLog(true,'Gagal Menyimpan Notification');
            return redirect('notification')->with('alert_error', 'Gagal Disimpan');
        }

        if($request->notification_type != Notification::NOTIFICATION_TYPE_PARENT)
        {
            $all_user_teacher = User::whereNotIn('account_type', [User::ACCOUNT_TYPE_PARENT,User::ACCOUNT_TYPE_CREATOR])->get();

            foreach ($all_user_teacher as $user_teacher) {

                // Input ke User Notifikasi
                $user_notification = new UserNotification();
               
                $user_notification->notification_id = $notification->id;
                $user_notification->user_id = $user_teacher->id;
                $user_notification->status = UserNotification::STATUS_UNREAD;

                if(!$user_notification->save())
                {
                    DB::rollBack();
                }
            }
        }
        else
        {
            $all_user_parent = User::where('account_type', User::ACCOUNT_TYPE_PARENT)->get();

            foreach ($all_user_parent as $user_parent) {
               
                $user_notification->notification_id = $notification->id;
                $user_notification->user_id = $user_parent->id;
                $user_notification->status = UserNotification::STATUS_UNREAD;

                if(!$user_notification->save())
                {
                    DB::rollBack();
                }
            }
        }

        if($this->getUserPermission('create notification'))
        {
            DB::commit();
            $this->systemLog(false,'Berhasil Menyimpan Input Notification');
            return redirect('notification')->with('alert_success', 'Berhasil Disimpan');
        }
        else
        {
            DB::rollBack();
            $this->systemLog(true,'Gagal Menyimpan Input Notification');
            return redirect('notification')->with('alert_error', 'Gagal Disimpan');
        }
    }
}
