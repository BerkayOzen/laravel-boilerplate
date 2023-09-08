<?php

namespace App\Domains\Domain;

use App\Domains\Cache\Cache;
use App\Domains\Domain\Traits\Transactionable;
use App\Domains\Domain\Traits\Authorizable;
use App\Domains\Domain\Traits\Validatable;
use Exception;

class Action extends Domain
{
    use Authorizable;
    use Validatable;
    use Transactionable;

    /**
     * @param $action
     * @return mixed
     */
    protected function execute($action)
    {
        try {
            $this->callAuthorization();
            $this->callValidation();
            $response = $this->callWithTransaction($action);
            $this->callClearCache($action);
            $this->callSuccess($action, $response);

            return $response;
        } catch (Exception $exception) {
            return $this->callFail($action, $exception);
        }
    }

    /**
     * @param $action
     */
    protected function callClearCache($action){
        if (method_exists($action, 'clearCache')) {
            Cache::tags($action->clearCache())->flush();
        }
    }
}
