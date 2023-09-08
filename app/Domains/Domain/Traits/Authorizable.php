<?php

namespace App\Domains\Domain\Traits;

use Illuminate\Validation\UnauthorizedException;

trait Authorizable
{
    /**
     *
     */
    private function callAuthorization()
    {
        if (method_exists($this, 'authorization')) {
            $authorization = $this->authorization();
            if (!$authorization) {
                throw new UnauthorizedException(__('authorization.failed'));
            }
        }
    }
}
