<?php

namespace App\Domains\Domain\Traits;

trait Eloquentable
{
    protected $with = [];
    protected $whereHas = null;
    protected $has;
    protected $paginate = null;
    protected $uuid;

    /**
     * @param $with
     * @return $this
     */
    public function with($with)
    {
        $this->with = $with;

        return $this;
    }

    /**
     * @param $whereHas
     * @return $this
     */
    public function whereHas($whereHas)
    {
        $this->whereHas = $whereHas;

        return $this;
    }

    /**
     * @param $has
     * @return $this
     */
    public function has($has)
    {
        $this->has = $has;

        return $this;
    }

    /**
     * @param $page
     * @return $this
     */
    public function paginate($page)
    {
        $this->paginate = $page;

        return $this;
    }

    /**
     * @param $uuid
     * @return $this
     */
    public function uuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }
}
