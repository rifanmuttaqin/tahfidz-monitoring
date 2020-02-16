<?php

namespace App\Model\Surah;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Surah extends Model
{
    protected $table = 'tbl_surah';
    protected $guard_name = 'web';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'surah_name', 
        'total_ayat'
    ];

    public static $rules = [
        'surah_name' => 'required',
        'total_ayat' => 'required | interger'
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
    public static function getSurah($search=null)
    {
        return self::where('surah_name', 'like', '%'.$search.'%')->get();
    }

}