<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
//    public function handle($request, Closure $next, ...$guards)
//    {
//        if (!$request->headers->has('Authorization')) {
//            $request->headers->set('Authorization', 'Bearer ' . Request::capture()->cookies->get('Authorization'));
//        }
//
//        if ($this->authenticate($request, $guards) === 'authentication_error') {
//            throw new AuthenticationException();
//        }
//        return $next($request);
//    }
//
//    protected function authenticate($request, array $guards)
//    {
//        if (empty($guards)) {
//            $guards = [null];
//        }
//        foreach ($guards as $guard) {
//            if ($this->auth->guard($guard)->check()) {
//                return $this->auth->shouldUse($guard);
//            }
//        }
//        return 'authentication_error';
//    }


    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
