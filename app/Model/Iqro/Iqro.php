<?php

namespace App\Model\Iqro;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class Iqro extends Model
{
    protected $table = 'tbl_iqro';
    protected $guard_name = 'web';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jilid_number', 
        'total_page'
    ];

    public static $rules = [
        'jilid_number' => 'required | interger',
        'total_page' => 'required | interger'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}