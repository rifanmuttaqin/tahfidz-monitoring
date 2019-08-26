<?php

namespace App\Model\StudentClass;

use Auth;

use App\Model\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StudentClass extends Model
{
    // use Filterable;

    protected $table = 'tbl_class';
    protected $guard_name = 'web';
    
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
    public static function validateClass($angkatan, $class_name, $guru)
    {
        $data = self::where('angkatan',$angkatan)->where('class_name',$class_name)->where('teacher_id',$guru)->first();

        if($data != null)
        {
            return true;
        }

        return false;
    }


    /**
     * 
     */
    public static function getClass($search=null)
    {
        $user = Auth::user();

        if($user->account_type == User::ACCOUNT_TYPE_TEACHER)
        {
            return self::where('class_name', 'like', '%'.$search.'%')->where('teacher_id',$user->id)->get();
        }

        return self::where('class_name', 'like', '%'.$search.'%')->get();
    }


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