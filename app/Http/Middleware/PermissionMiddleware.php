<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $permission
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $permission)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Check if user has the required permission
        if (!$this->userHasPermission($user, $permission)) {
            abort(403, 'Unauthorized. You do not have permission to access this resource.');
        }

        return $next($request);
    }

    /**
     * Check if user has a specific permission
     */
    protected function userHasPermission($user, string $permission): bool
    {
        // Check if user has admin or super_admin role assigned
        if ($this->userHasRole($user, ['admin', 'super_admin'])) {
            return true;
        }

        // Check user's assigned roles and their permissions
        foreach ($user->roles as $role) {
            foreach ($role->permissions as $userPermission) {
                if ($userPermission->name === $permission) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Check if user has any of the specified roles
     */
    protected function userHasRole($user, array $roles): bool
    {
        foreach ($user->roles as $role) {
            if (in_array($role->name, $roles)) {
                return true;
            }
        }
        return false;
    }
}