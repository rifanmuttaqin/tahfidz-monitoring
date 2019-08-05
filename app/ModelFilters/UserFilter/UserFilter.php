<?php 
namespace App\ModelFilters\UserFilter;

use EloquentFilter\ModelFilter;

class UserFilter extends ModelFilter
{
	public function userName($username)
    {
        return $this->where(function($q) use ($username)
        {
            return $q->where('username', 'LIKE', "%$username%");
        });
    }

    public function address($address)
    {
        return $this->where(function($q) use ($address)
        {
            return $q->where('address', 'LIKE', "%$address%");
        });
    }

    public function fullName($full_name)
    {
        return $this->where(function($q) use ($full_name)
        {
            return $q->where('full_name', 'LIKE', "%$full_name%");
        });
    }

    public function accountType($account_type)
    {
        return $this->where(function($q) use ($account_type)
        {
            return $q->where('account_type', 'account_type');
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
