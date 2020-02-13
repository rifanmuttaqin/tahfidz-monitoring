<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserLoginHistory extends Model
{
    protected $table = 'tbl_user_login_history';
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'last_login_ip',
        'date'
    ];

    public static $rules = [
        'user_id' => 'required | integer',
        'last_login_ip' => 'required | string',
        'date' => 'required | date',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public static function findLastlogin()
    {
    	return self::orderBy('created_at', 'desc')->first();
    }


    /**
     * 
     */
    public function getUser()
    {
        return $this->hasOne('App\Model\User\User','id','user_id');
    }

}
