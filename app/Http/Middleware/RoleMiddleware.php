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
        // Accept multiple roles separated by | or ,
        $roles = preg_split('/[\|,]/', $role);

        if (!Auth::check()) {
            // Not logged in → redirect to login based on first role
            return $this->redirectByRole($roles[0] ?? 'user');
        }

        // If user has Spatie roles available, use hasAnyRole; otherwise fall back to string compare
        $user = Auth::user();

        $hasRole = false;
        if (method_exists($user, 'hasAnyRole')) {
            $hasRole = $user->hasAnyRole($roles);
        } else {
            $hasRole = in_array($user->role, $roles, true);
        }

        if (! $hasRole) {
            // Logged in but wrong role → redirect to their dashboard
            $currentRole = method_exists($user, 'getRoleNames') ? ($user->getRoleNames()->first() ?? $user->role) : $user->role;
            return $this->redirectToDashboard($currentRole);
        }

        return $next($request);
    }

    protected function redirectByRole($role)
    {
        return $role === 'super_admin'
            ? redirect()->route('superadmin.login')
            : redirect()->route('login');
    }

    protected function redirectToDashboard($role)
    {
        return match ($role) {
            'super_admin' => redirect()->route('superadmin.dashboard'),
            'user'       => redirect()->route('user.dashboard'),
            default      => redirect()->route('login'),
        };
    }
}
