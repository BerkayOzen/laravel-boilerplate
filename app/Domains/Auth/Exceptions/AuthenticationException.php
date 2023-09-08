<?php

namespace App\Domains\Auth\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthenticationException extends HttpException
{
    protected $code = 401;
    protected $message = 'login.unauthorized';

    public function __construct($message = null)
    {
        $this->message = $message ?: $this->message;
        parent::__construct($this->code, __($this->message));
    }

}
