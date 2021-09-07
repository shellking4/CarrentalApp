<?php

namespace App\Role;

class UserRole
{
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    protected static $roleHierachy = [
        self::ROLE_ADMIN => ['*'],
        self::ROLE_USER => [self::ROLE_USER]
    ];

    public static function getAllowedRoles(string $role)
    {
        if (isset(self::$roleHierachy[$role])) {
            return self::$roleHierachy[$role];
        }
        return [];
    }

    public static function getRoleList()
    {
        return [
            static::ROLE_ADMIN => 'admin',
            static::ROLE_USER => 'user'
        ];
    }
}
