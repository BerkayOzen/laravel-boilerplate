<?php

namespace App\Domains\Auth;

use App\Domains\User\UserGate;

class AuthGate
{
    public static function me()
    {
        return UserGate::me(static::user())->run();
    }

    public static function user()
    {
        return (new Queries\User())->run();
    }

    public static function check(...$permissions)
    {
        $isCheck = UserGate::check(static::user(), ...$permissions)->run();

//        if (!$isCheck) {
//            Error::getInstance()->push(self::getPermissionErrorMessage($permissions));
//        }

        return $isCheck;
    }

}
