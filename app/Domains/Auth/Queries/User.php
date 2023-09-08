<?php

namespace App\Domains\Auth\Queries;

use App\Domains\Domain\Query;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Query
{
    /**
     * @return Authenticatable|null
     */
    protected function handle()
    {
        return Auth::user();
    }
}
