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
}
