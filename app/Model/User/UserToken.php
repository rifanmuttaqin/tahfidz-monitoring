<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;


class UserToken extends Model
{
    protected $table = 'tbl_user_token';
    protected $guard_name = 'web';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','token', 'date_expired'
    ];

    public static $rules = [
        'user_id' => 'required | unique',
        'token' => 'string | unique',
        'date_expired' => 'required | integer'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    
    ];


}
