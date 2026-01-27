<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;

class RolePermissionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('super_admin')) {
            $roles = Role::all();
            $permissions = Permission::all();
            $users = User::all();
        } elseif ($user->hasRole('admin')) {
            $roles = Role::all();
            $permissions = Permission::all();
            $users = User::where('created_by', $user->id)->get();
        } else {
            $roles = Role::where(function($q) use ($user) {
                $q->whereNull('user_id')->orWhere('user_id', $user->id);
            })->get();

            $permissions = Permission::where(function($q) use ($user) {
                $q->whereNull('user_id')->orWhere('user_id', $user->id);
            })->get();

            $users = User::where('created_by', $user->id)->get();
        }

        return view('admin.roles.index', compact('roles', 'permissions', 'users'));
    }

    public function storeRole(Request $request)
    {
        $user = Auth::user();

        $rules = ['name' => 'required|string'];

        if (!$user->hasRole('super_admin') && !$user->hasRole('admin')) {
            $rules['name'] .= '|unique:roles,name,NULL,id,user_id,' . $user->id;
        } else {
            $rules['name'] .= '|unique:roles,name,NULL,id,user_id,NULL';
        }

        $request->validate($rules);

        $role = Role::create([
            'name' => $request->name,
            'user_id' => ($user->hasRole('super_admin') || $user->hasRole('admin')) ? null : $user->id,
        ]);

        return redirect()->back()->with('success', 'Role created.');
    }

    public function storePermission(Request $request)
    {
        $user = Auth::user();

        $rules = ['name' => 'required|string'];

        if (!$user->hasRole('super_admin') && !$user->hasRole('admin')) {
            $rules['name'] .= '|unique:permissions,name,NULL,id,user_id,' . $user->id;
        } else {
            $rules['name'] .= '|unique:permissions,name,NULL,id,user_id,NULL';
        }

        $request->validate($rules);

        $perm = Permission::create([
            'name' => $request->name,
            'user_id' => ($user->hasRole('super_admin') || $user->hasRole('admin')) ? null : $user->id,
        ]);

        return redirect()->back()->with('success', 'Permission created.');
    }

    public function assignRoleToUser(Request $request)
    {
        $request->validate(['user_id' => 'required|numeric', 'role' => 'required|string']);

        $user = User::findOrFail($request->user_id);

        // Only allow if current user is creator of the user or super_admin
        $current = Auth::user();
        if (! ($current->hasRole('super_admin') || $user->created_by === $current->id)) {
            abort(403, 'Unauthorized');
        }

        $roleName = $request->role;

        // Allow admins and super_admins to access all roles
        if ($current->hasRole('super_admin') || $current->hasRole('admin')) {
            $role = Role::where('name', $roleName)->first();
        } else {
            $role = Role::where('name', $roleName)
                ->where(function($q) use ($current) {
                    $q->whereNull('user_id')->orWhere('user_id', $current->id);
                })->first();
        }

        if (! $role) {
            abort(404, 'Role not found or not permitted');
        }

        $user->syncRoles([$roleName]);

        return redirect()->back()->with('success', 'Role assigned to user.');
    }

    public function assignPermissionToRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'permissions' => 'required|array|min:1',
            'permissions.*' => 'required|string'
        ]);

        $current = Auth::user();

        $targetUser = User::find($request->user_id);

        // Check if current user can assign to this user
        if (!$current->hasRole('super_admin') && $targetUser->created_by !== $current->id) {
            return redirect()->back()->with('error', 'You can only assign permissions to users you created.');
        }

        $assignedPermissions = [];
        $createdPermissions = [];

        // Process each selected permission
        foreach ($request->permissions as $permissionName) {
            // Allow admins and super_admins to access all permissions
            if ($current->hasRole('super_admin') || $current->hasRole('admin')) {
                $permission = Permission::where('name', $permissionName)->first();
            } else {
                $permission = Permission::where('name', $permissionName)
                    ->where(function($q) use ($current) {
                        $q->whereNull('user_id')->orWhere('user_id', $current->id);
                    })->first();
            }

            if (!$permission) {
                $permission = Permission::create([
                    'name' => $permissionName,
                    'user_id' => ($current->hasRole('super_admin') || $current->hasRole('admin')) ? null : $current->id,
                ]);
                $createdPermissions[] = $permissionName;
            }

            $assignedPermissions[] = $permission->id;
        }

        // Attach all permissions to user via pivot (syncWithoutDetaching to avoid removing existing ones)
        $targetUser->permissions()->syncWithoutDetaching($assignedPermissions);

        $message = count($request->permissions) . ' permission(s) assigned to user "' . $targetUser->name . '"';
        if (!empty($createdPermissions)) {
            $message .= '. Created new permission(s): ' . implode(', ', $createdPermissions);
        }

        return redirect()->back()->with('success', $message);
    }

    public function userRolesPermissions()
    {
        $user = Auth::user();

        // Get user's assigned roles
        $userRoles = $user->roles;

        // Get all permissions for the user's roles
        $userPermissions = collect();
        foreach ($userRoles as $role) {
            $userPermissions = $userPermissions->merge($role->permissions);
        }
        $userPermissions = $userPermissions->unique('id');

        return view('user.roles-permissions', compact('userRoles', 'userPermissions'));
    }

    /**
     * Example method showing how to check permissions in controllers
     */
    public function examplePermissionCheck()
    {
        $user = Auth::user();

        // Method 1: Using the helper method
        if (!$user->hasPermission('manage users')) {
            abort(403, 'You do not have permission to manage users.');
        }

        // Method 2: Using hasAnyPermission for multiple permissions
        if (!$user->hasAnyPermission(['manage users', 'view users'])) {
            abort(403, 'You do not have permission to access user management.');
        }

        // Method 3: Using hasAllPermissions for requiring all permissions
        if (!$user->hasAllPermissions(['manage users', 'delete users'])) {
            abort(403, 'You need both manage and delete user permissions.');
        }

        // Your controller logic here
        return response()->json(['message' => 'Permission check passed!']);
    }
}
