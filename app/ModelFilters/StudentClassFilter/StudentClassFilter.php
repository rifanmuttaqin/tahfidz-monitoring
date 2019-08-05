<?php 

namespace App\ModelFilters\StudentClassFilter;

use EloquentFilter\ModelFilter;


class StudentClassFilter extends ModelFilter
{
	public function className($class_name)
    {
        return $this->where(function($q) use ($class_name)
        {
            return $q->where('class_name', 'LIKE', "%$class_name%");
        });
    }

    // Relation Serach
    public function teacherName($teacher_name)
    {
        $this->related('getTeacher', function($query) use ($teacher_name) {
            return $query->where('full_name', 'LIKE', "%$teacher_name%");
        });
    }

    public function note($note)
    {
        return $this->where(function($q) use ($note)
        {
            return $q->where('note', 'LIKE', "%$note%");
        });
    }

    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [
        'getTeacher' => ['teacherName']
    ];
}
