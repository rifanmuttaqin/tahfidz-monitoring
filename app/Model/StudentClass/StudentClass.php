<?php

namespace App\Model\StudentClass;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class StudentClass extends Model
{
    use Filterable;

    protected $table = 'tbl_class';
    protected $guard_name = 'api';
    
     /**
     * modelFilter Function
     */
    public function modelFilter()
    {
        return $this->provideFilter(App\ModelFilters\StudentClassFilter\StudentClassFilter::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'class_name', 
        'note', 
        'angkatan',
        'teacher_id',
        'teacher_name'
    ];

    public static $rules = [
        'class_name' => 'required',
        'angkatan' => 'string',
        'note' => 'string',
        'teacher_id' => 'required | interger',
        'teacher_name' => 'string'
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
    public function getTeacher()
    {
        return $this->hasOne('App\Model\User\User','id','teacher_id');
    }

    public function getSiswa()
    {
        return $this->belongsTo('App\Model\Siswa\Siswa');
    }

}