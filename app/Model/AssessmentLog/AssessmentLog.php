<?php

namespace App\Model\AssessmentLog;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class AssessmentLog extends Model
{
    protected $table = 'tbl_assessment_log';
    protected $guard_name = 'web';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'siswa_id', 
        'range',
        'date',
        'assessment'
    ];

    public static $rules = [
        'siswa_id' => 'required | interger',
        'range' => 'required | string',
        'date' => 'required | date',
        'assessment' => 'required | string',
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
    public function getSiswa()
    {
        return $this->belongsTo('App\Model\Siswa\Siswa', 'siswa_id', 'id');
    }

}