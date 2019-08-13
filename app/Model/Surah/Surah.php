<?php

namespace App\Model\Surah;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Surah extends Model
{
    protected $table = 'tbl_surah';
    protected $guard_name = 'web';
    
     /**
     * modelFilter Function
     */
    public function modelFilter()
    {
        return $this->provideFilter(App\ModelFilters\SurahFilter\SurahFilter::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'surah_name', 
        'juz', 
        'total_ayat'
    ];

    public static $rules = [
        'surah_name' => 'required',
        'juz' => 'required | interger',
        'total_ayat' => 'required | interger'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

}