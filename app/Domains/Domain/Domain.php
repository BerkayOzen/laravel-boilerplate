<?php

namespace App\Domains\Domain;

class Domain
{
    /**
     * @return static
     */
    public static function make()
    {
        return new static(...func_get_args());
    }

    /**
     * @param callable|null $query
     * @return mixed
     */
    public function run(callable $query = null)
    {
        $query = $query ?: $this;
        return $this->execute($query);
    }

    /**
     * @param $action
     * @param $response
     * @return mixed
     */
    protected function callSuccess($action, $response)
    {
        if (method_exists($action, 'success')) {
            $response = $action->success($response);
        }
        return $response;
    }

    /**
     * @param $action
     * @param $exception
     * @return mixed
     */
    protected function callFail($action, $exception)
    {
        if (method_exists($action, 'fail')) {
            return $action->fail($exception);
        }
        throw $exception;
    }

    /**
     * @param $action
     * @return mixed
     */
    protected function call($action)
    {
        if (is_callable($action)) {
            return $action();
        }
        $when = $this->callWhen($action);
        if (!$when) {
            return false;
        }
        return $action->handle();
    }

    /**
     * @param $action
     * @return bool
     */
    private function callWhen($action)
    {
        if (method_exists($action, 'when')) {
            return $action->when();
        }
        return true;
    }
}
