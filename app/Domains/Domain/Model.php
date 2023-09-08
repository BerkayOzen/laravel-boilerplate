<?php

namespace App\Domains\Domain;

use Spatie\DataTransferObject\DataTransferObject;

abstract class Model extends DataTransferObject
{
    public static function collection(array $items)
    {
        return collect($items)->map(function ($item) {
            return new static($item);
        });
    }
}
