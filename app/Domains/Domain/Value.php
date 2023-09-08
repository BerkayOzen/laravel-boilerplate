<?php

namespace App\Domains\Domain;

class Value
{
    /**
     * @var
     */
    protected $value;

    /**
     * Similarity constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->value;
    }
}
