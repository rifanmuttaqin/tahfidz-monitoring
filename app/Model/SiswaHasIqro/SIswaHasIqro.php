<?php

namespace App\Model\SiswaHasIqro;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SiswaHasIqro extends Model
{
    // use Filterable;

    protected $table = 'tbl_siswa_has_iqro';
    protected $guard_name = 'web';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'siswa_id', 
        'iqro_id',
        'page',
        'date',
        'note' 
    ];

    public static $rules = [
        'iqro_id' => 'required | integer',
        'siswa_id' => 'required | integer',
        'page' => 'required | integer',
        'date' => 'date',
        'note' => 'string',
        'group_page' => 'string | required',
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
    public function getIqro()
    {
        return $this->hasOne('App\Model\Iqro\Iqro','id','iqro_id');
    }

    /**
     * 
     */
    public static function AssessmentValidation($siswa_id,$iqro_id,$page)
    {
        $data = self::where('siswa_id',$siswa_id)->where('iqro_id',$iqro_id)->where('page',$page)->first();

        if($data)
        {
            return data;
        }

        return null;
    }

}