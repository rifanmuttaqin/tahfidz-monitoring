<?php

namespace App\Model\Siswa;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class Siswa extends Model
{
    use Filterable;

    protected $table = 'tbl_siswa';
    protected $guard_name = 'api';
 
    const TYPE_IQRO = 10;
    const TYPE_QURAN = 20;
       
     /**
     * modelFilter Function
     */
    public function modelFilter()
    {
        return $this->provideFilter(App\ModelFilters\SiswaFilter\SiswaFilter::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'siswa_name', 
        'class_id', 
        'parent_id',
        'memorization_type'
    ];

    public static $rules = [
        'siswa_name' => 'required',
        'class_id' => 'required | integer',
        'parent_id' => 'required | integer',
        'memorization_type' => 'required | integer'
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
    public function getParent()
    {
        return $this->hasOne('App\Model\User\User','id','parent_id');
    }

    /**
     * 
     */
    public function getClass()
    {
        return $this->hasOne('App\Model\StudentClass\StudentClass','id','class_id');
    }

}