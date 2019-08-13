<?php

namespace App\Model\Helper;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    protected $table = 'roles';
    protected $guard_name = 'web';

    public static function isExists($name, $guard_name)
    {
        if (!self::where('name', $name)->where('guard_name', $guard_name)->first())
        {
            return false;
        }

        return true;
    }

    public static function createIfNotExists($name, $guard_name)
    {
        if (!self::isExists($name, $guard_name))
        {
            self::create(['name' => $name, 'guard_name' => $guard_name]);
        }

        return self::where('name', $name)->where('guard_name', $guard_name)->first();
    }
}
