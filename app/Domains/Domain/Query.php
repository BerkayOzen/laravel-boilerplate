<?php

namespace App\Domains\Domain;

use App\Domains\Domain\Traits\Authorizable;
use App\Domains\Domain\Traits\Eloquentable;
use App\Domains\Domain\Traits\Validatable;

class Query extends Domain
{
    use Authorizable;
    use Validatable;
    use Eloquentable;

    /**
     * @param $query
     * @return mixed
     */
    protected function execute($query)
    {
        try {
            $this->callAuthorization();
            $this->callValidation();

            if (method_exists($query, 'cache')) {
                $response = $query->cache()->run(function () use ($query) {
                    return $this->call($query);
                });
            } else {
                $response = $this->call($query);
            }
            $this->callSuccess($query, $response);

            return $response;
        } catch (\Exception $exception) {
            return $this->callFail($query, $exception);
        }
    }
}
