<?php

namespace App\Model\Notification;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class Notification extends Model
{
    const NOTIFICATION_TYPE_PARENT = 10;
    const NOTIFICATION_TYPE_TEACHER = 20;

    protected $table = 'tbl_notification';
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'notification_type',
        'notification_title',
        'notification_message',
        'date'
    ];

    /**
     *
     */
    public static $rules = [
        'notification_type' => 'required | interger',
        'notification_title' => 'required | string',
        'date' => 'required | date',
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
    public static function getTypeMeaning($notification_type)
    {
        switch ($notification_type) {
            case static::NOTIFICATION_TYPE_PARENT:
               return 'Untuk Orangtua';
            case static::NOTIFICATION_TYPE_TEACHER:
               return 'Untuk Guru';
            default:
                return '';
        }
    }
}
