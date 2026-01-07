<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {

            // Superadmin URLs → superadmin login
            if ($request->is('super_admin/*')) {
                return route('superadmin.login');
            }

            // Default user login
            return route('login');
        }
    }
}
