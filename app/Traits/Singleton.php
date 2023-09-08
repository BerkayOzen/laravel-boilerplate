<?php

namespace App\Traits;

trait Singleton
{
    protected static $instances = [];

    /**
     * @return static
     */
    final public static function instance()
    {
        return static::getInstance(...func_get_args());
    }

    /**
     * @return static
     */
    final public static function getInstance()
    {
        return isset(static::$instances[static::class])
            ? static::$instances[static::class]
            : static::$instances[static::class] = new static(...func_get_args());
    }
}
