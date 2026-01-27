<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Blade directive for checking if user has a specific permission
        Blade::if('hasPermission', function ($permission) {
            if (!Auth::check()) {
                return false;
            }

            $user = Auth::user();

            // Check if user has admin or super_admin role assigned
            foreach ($user->roles as $role) {
                if (in_array($role->name, ['admin', 'super_admin'])) {
                    return true;
                }
            }

            // Check direct permissions
            foreach ($user->permissions as $userPermission) {
                if ($userPermission->name === $permission) {
                    return true;
                }
            }

            // Check user's assigned permissions through roles
            foreach ($user->roles as $role) {
                foreach ($role->permissions as $userPermission) {
                    if ($userPermission->name === $permission) {
                        return true;
                    }
                }
            }

            return false;
        });

        // Blade directive for checking if user has any of the specified permissions
        Blade::if('hasAnyPermission', function ($permissions) {
            if (!Auth::check()) {
                return false;
            }

            $user = Auth::user();

            // Check if user has admin or super_admin role assigned
            foreach ($user->roles as $role) {
                if (in_array($role->name, ['admin', 'super_admin'])) {
                    return true;
                }
            }

            $permissions = is_array($permissions) ? $permissions : [$permissions];

            foreach ($user->roles as $role) {
                foreach ($role->permissions as $userPermission) {
                    if (in_array($userPermission->name, $permissions)) {
                        return true;
                    }
                }
            }

            return false;
        });

        // Blade directive for checking if user has all specified permissions
        Blade::if('hasAllPermissions', function ($permissions) {
            if (!Auth::check()) {
                return false;
            }

            $user = Auth::user();

            // Admin and super_admin have all permissions (check via roles)
            if (method_exists($user, 'hasAnyRole') && $user->hasAnyRole(['admin', 'super_admin'])) {
                return true;
            }

            $permissions = is_array($permissions) ? $permissions : [$permissions];
            $userPermissions = [];

            foreach ($user->roles as $role) {
                foreach ($role->permissions as $userPermission) {
                    $userPermissions[] = $userPermission->name;
                }
            }

            foreach ($permissions as $permission) {
                if (!in_array($permission, $userPermissions)) {
                    return false;
                }
            }

            return true;
        });

        // Blade directive for checking if user has a specific role
        Blade::if('hasRole', function ($role) {
            if (!Auth::check()) {
                return false;
            }

            $user = Auth::user();
            return $user->hasRole($role);
        });

        // Blade directive for checking if user has any of the specified roles
        Blade::if('hasAnyRole', function ($roles) {
            if (!Auth::check()) {
                return false;
            }

            $user = Auth::user();
            return $user->hasAnyRole($roles);
        });
    }
}