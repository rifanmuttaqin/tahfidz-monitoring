<?php

namespace App\Model\UserNotification;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserNotification extends Model
{
	protected $table = 'tbl_user_notification';

    const STATUS_UNREAD = 10;
    const STATUS_READ 	= 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'notification_id',
        'status',
    ];

    /**
     */
    public static $rules = [
        'user_id' => 'required | interger',
        'notification_id' => 'required | interger',
        'status' => 'required | interger'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * 
     */
    public function getUser()
    {
        return $this->hasOne('App\Model\User\User','id','user_id');
    }

    /**
     * 
     */
    public function getNotification()
    {
        return $this->hasOne('App\Model\Notification\Notification','id','notification_id');
    }
 
}
