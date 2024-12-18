<?php

namespace App\Enum;

class RoleEnum
{
    const MANAGER = 1;
    const DEVELOPER = 2;

    public static function allRoles()
    {
        return [
            self::MANAGER,
            self::DEVELOPER,
        ];
    }

    public static function isValidRole(int $role)
    {
        return in_array($role, self::allRoles(), true);
    }
}
