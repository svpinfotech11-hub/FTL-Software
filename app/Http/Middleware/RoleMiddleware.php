<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            // Not logged in → redirect to login based on role
            return $this->redirectByRole($role);
        }

        if (Auth::user()->role !== $role) {
            // Logged in but wrong role → redirect to their dashboard
            return $this->redirectToDashboard(Auth::user()->role);
        }

        return $next($request);
    }

    protected function redirectByRole($role)
    {
        return $role === 'superadmin'
            ? redirect()->route('superadmin.login')
            : redirect()->route('login');
    }

    protected function redirectToDashboard($role)
    {
        return match ($role) {
            'superadmin' => redirect()->route('superadmin.dashboard'),
            'user'       => redirect()->route('user.dashboard'),
            default      => redirect()->route('login'),
        };
    }
}
