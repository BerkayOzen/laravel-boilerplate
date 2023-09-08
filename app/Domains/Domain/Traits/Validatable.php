<?php

namespace App\Domains\Domain\Traits;

trait Validatable
{
    /**
     *
     */
    private function callValidation()
    {
        if (method_exists($this, 'validation')) {
            $validation = $this->validation();
            $validation->validate();
        }
    }
}
