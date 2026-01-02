<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {

            // 👇 SUPERADMIN URL CHECK
            if ($request->is('superadmin/*')) {
                return route('superadmin.login');
            }

            // 👇 DEFAULT USER LOGIN
            return route('login');
        }
    }

}
