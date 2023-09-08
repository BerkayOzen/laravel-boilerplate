<?php

namespace App\Domains\User;

use App\Domains\User\Queries\Check;
use App\Domains\User\Queries\Me;
use App\Models\User;

class UserGate
{
    public static function check(User $user, ...$permission)
    {
        return (new Check($user, ...$permission));
    }

    public static function me(User $user)
    {
        return (new Me($user));
    }
}
