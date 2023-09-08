<?php

namespace App\Domains\User\Queries;

use App\Domains\Domain\Query;
use App\Models\User;

class Check extends Query
{
    private $user;
    private $permissions;
    private $currentPermissions;

    public function __construct(User $user, ...$permissions)
    {
        $this->user = $user;
        $this->permissions = collect($permissions);
    }

    protected function handle()
    {
        if (!isset($this->currentPermissions[$this->user->id])) {
            $this->currentPermissions[$this->user->id] = $this->user->currentPermissions();
        }

        $permissions = $this->currentPermissions[$this->user->id]->pluck('name');

        // TODO kapsayıcı permission olduğu zaman aç
//        $this->currentPermissions[$this->user->id]->each(function ($permission) use (&$permissions) {
//            $permissions = $permissions->merge($permission->includes);
//        });

        return $this->permissions->intersect($permissions)->count() > 0;
    }

}
