<?php 
namespace App\ModelFilters\SurahFilter;

use EloquentFilter\ModelFilter;

class SurahFilter extends ModelFilter
{
	public function surahName($surah_name)
    {
        return $this->where(function($q) use ($surah_name)
        {
            return $q->where('surah_name', 'LIKE', "%$surah_name%");
        });
    }

    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];
}
