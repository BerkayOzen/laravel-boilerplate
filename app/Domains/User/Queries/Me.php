<?php

namespace App\Domains\User\Queries;

use App\Domains\Domain\Query;
use App\Models\User;

class Me extends Query
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    protected function handle()
    {
        $permissions = $this->user->currentPermissions();
        $this->user->setRelation('currentPermissions', $permissions);
        return $this->user;
    }
}
