<?php 

namespace App\ModelFilters\SiswaFilter;

use EloquentFilter\ModelFilter;


class SiswaFilter extends ModelFilter
{
	public function siswaName($siswa_name)
    {
        return $this->where(function($q) use ($siswa_name)
        {
            return $q->where('siswa_name', 'LIKE', "%$siswa_name%");
        });
    }

    // Relation Serach
    public function parentName($parent_name)
    {
        $this->related('getParent', function($query) use ($parent_name) {
            return $query->where('full_name', 'LIKE', "%$parent_name%");
        });
    }

    // Relation Serach
    public function className($class_name)
    {
        $this->related('getClass', function($query) use ($class_name) {
            return $query->where('class_name', 'LIKE', "%$class_name%");
        });
    }

    
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [
        'getParent' => ['parentName'],
        'getClass' => ['className']
    ];
}
