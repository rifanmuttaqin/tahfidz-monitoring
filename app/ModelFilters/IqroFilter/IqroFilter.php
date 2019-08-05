<?php 
namespace App\ModelFilters\IqroFilter;

use EloquentFilter\ModelFilter;

class IqroFilter extends ModelFilter
{
    /**
    * @var array
    */
	public function jilidNumber($jilid_number)
    {
        return $this->where('jilid_number', $jilid_number);
    }

    /**
    * @var array
    */
    public function totalPage($total_page)
    {
        return $this->where('total_page', $total_page);
    }

    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];
}
