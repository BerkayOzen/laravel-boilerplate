<?php

namespace App\Domains\Domain\Traits;

use Illuminate\Support\Facades\DB;

trait Transactionable
{
    protected $transaction = false;

    /**
     * @return $this
     */
    public function transaction()
    {
        $this->transaction = true;

        return $this;
    }

    /**
     * @param $action
     * @return mixed
     */
    protected function callWithTransaction($action)
    {
        return $this->transaction ? DB::transaction(function () use ($action) {
            return $this->call($action);
        }) : $this->call($action);
    }
}
