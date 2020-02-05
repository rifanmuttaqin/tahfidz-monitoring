<?php

namespace App\Model\SiswaHasSurah;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SiswaHasSurah extends Model
{
    // use Filterable;

    protected $table = 'tbl_siswa_has_surah';
    protected $guard_name = 'web';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'siswa_id', 
        'surah_id',
        'ayat',
        'date',
        'note' 
    ];

    public static $rules = [
        'surah_id' => 'required | integer',
        'siswa_id' => 'required | integer',
        'ayat' => 'required | integer',
        'group_ayat' => 'string | required',
        'date' => 'date',
        'note' => 'string',
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
    public function getSurah()
    {
        return $this->hasOne('App\Model\Surah\Surah','id','surah_id');
    }

    /**
     * 
     */
    public static function AssessmentValidation($siswa_id,$surah_id,$ayat)
    {
        $data = self::where('siswa_id',$siswa_id)->where('surah_id',$surah_id)->where('ayat',$ayat)->first();

        if($data)
        {
            return $data;
        }

        return null;
    }

}