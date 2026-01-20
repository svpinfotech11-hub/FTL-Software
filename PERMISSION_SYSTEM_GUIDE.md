# Role-Based Access Control (RBAC) & Permission System

This document explains how to implement and use the comprehensive role-based access control system in your Laravel application.

## Overview

The system provides:
- **Role-based access control** (RBAC) with tenant scoping
- **Permission-based access control** for granular permissions
- **Middleware protection** for routes
- **Blade directives** for view-level permission checks
- **Helper methods** for controller permission validation

## Components

### 1. Middleware

#### RoleMiddleware (`role`)
- Protects routes based on user roles
- Supports multiple roles separated by `|` or `,`
- Redirects unauthorized users appropriately

```php
// Single role
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin-only routes
});

// Multiple roles
Route::middleware(['auth', 'role:admin|super_admin'])->group(function () {
    // Admin or super admin routes
});
```

#### PermissionMiddleware (`permission`)
- Protects routes based on specific permissions
- Supports single or multiple permissions
- Checks permissions through user's assigned roles

```php
// Single permission
Route::middleware(['auth', 'permission:manage users'])->group(function () {
    // Routes requiring 'manage users' permission
});

// Multiple permissions (user must have ANY of them)
Route::middleware(['auth', 'permission:manage users|view users'])->group(function () {
    // Routes requiring either permission
});
```

### 2. Blade Directives

#### Permission Directives
```blade
{{-- Check single permission --}}
@hasPermission('manage users')
    <p>You can manage users!</p>
    <a href="{{ route('users.create') }}">Create User</a>
@endhasPermission

{{-- Check any of multiple permissions --}}
@hasAnyPermission(['manage users', 'view users'])
    <p>You have user-related permissions!</p>
@endhasAnyPermission

{{-- Check all permissions (user must have ALL) --}}
@hasAllPermissions(['manage users', 'delete users'])
    <p>You can manage and delete users!</p>
@endhasAllPermissions

{{-- Check role --}}
@hasRole('admin')
    <p>You are an admin!</p>
@endhasRole

{{-- Check any role --}}
@hasAnyRole(['admin', 'manager'])
    <p>You are admin or manager!</p>
@endhasAnyRole
```

### 3. Controller Methods

#### User Model Helper Methods
```php
$user = Auth::user();

// Check single permission
if ($user->hasPermission('manage users')) {
    // User has permission
}

// Check any of multiple permissions
if ($user->hasAnyPermission(['manage users', 'view users'])) {
    // User has at least one permission
}

// Check all permissions
if ($user->hasAllPermissions(['manage users', 'delete users'])) {
    // User has all permissions
}

// Check role
if ($user->hasRole('admin')) {
    // User has role
}

// Check any role
if ($user->hasAnyRole(['admin', 'manager'])) {
    // User has at least one role
}
```

## Implementation Examples

### 1. Route Protection

```php
// web.php
Route::middleware(['auth'])->group(function () {
    // Role-based protection
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
    });

    // Permission-based protection
    Route::middleware(['permission:manage shipments'])->group(function () {
        Route::get('/shipments/advanced', [ShipmentController::class, 'advanced'])->name('shipments.advanced');
        Route::post('/shipments/bulk-update', [ShipmentController::class, 'bulkUpdate'])->name('shipments.bulk.update');
    });

    // Combined protection
    Route::middleware(['role:admin', 'permission:view reports'])->group(function () {
        Route::get('/reports/admin', [ReportController::class, 'admin'])->name('reports.admin');
    });
});
```

### 2. Controller Protection

```php
class UserController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        // Method 1: Abort if no permission
        if (!$user->hasPermission('manage users')) {
            abort(403, 'Unauthorized');
        }

        // Method 2: Redirect with message
        if (!$user->hasPermission('manage users')) {
            return redirect()->back()->with('error', 'You do not have permission to create users.');
        }

        return view('users.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Check multiple permissions
        if (!$user->hasAnyPermission(['manage users', 'create users'])) {
            return response()->json(['error' => 'Insufficient permissions'], 403);
        }

        // Your logic here
    }
}
```

### 3. View Protection

```blade
{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        {{-- Always visible --}}
        <div class="col-md-12">
            <h1>Dashboard</h1>
        </div>
    </div>

    {{-- Admin-only content --}}
    @hasRole('admin')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Admin Panel</h3>
                </div>
                <div class="card-body">
                    <p>Admin-specific content here</p>
                </div>
            </div>
        </div>
    </div>
    @endhasRole

    {{-- Permission-based content --}}
    @hasPermission('view reports')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Reports</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('reports.index') }}" class="btn btn-primary">View Reports</a>
                </div>
            </div>
        </div>
    </div>
    @endhasPermission

    {{-- Multiple permissions required --}}
    @hasAllPermissions(['manage users', 'manage roles'])
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>User & Role Management</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('users.index') }}" class="btn btn-success">Manage Users</a>
                    <a href="{{ route('roles.index') }}" class="btn btn-warning">Manage Roles</a>
                </div>
            </div>
        </div>
    </div>
    @endhasAllPermissions
</div>
@endsection
```

### 4. Sidebar Navigation

```blade
{{-- resources/views/layouts/sidebar.blade.php --}}
<ul class="nav nav-pills nav-sidebar flex-column">

    {{-- Always visible --}}
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
        </a>
    </li>

    {{-- Role-based menu items --}}
    @hasRole('admin')
    <li class="nav-item">
        <a href="{{ route('users.index') }}" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Users</p>
        </a>
    </li>
    @endhasRole

    {{-- Permission-based menu items --}}
    @hasPermission('manage shipments')
    <li class="nav-item">
        <a href="{{ route('shipments.index') }}" class="nav-link">
            <i class="nav-icon fas fa-truck"></i>
            <p>Shipments</p>
        </a>
    </li>
    @endhasPermission

    @hasPermission('view reports')
    <li class="nav-item">
        <a href="{{ route('reports.index') }}" class="nav-link">
            <i class="nav-icon fas fa-chart-bar"></i>
            <p>Reports</p>
        </a>
    </li>
    @endhasPermission

</ul>
```

## Database Structure

### Roles Table
```sql
CREATE TABLE roles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    user_id BIGINT UNSIGNED NULL, -- For tenant scoping
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

### Permissions Table
```sql
CREATE TABLE permissions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    user_id BIGINT UNSIGNED NULL, -- For tenant scoping
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

### Pivot Tables
```sql
-- Role-User relationship
CREATE TABLE role_user (
    user_id BIGINT UNSIGNED,
    role_id BIGINT UNSIGNED,
    PRIMARY KEY (user_id, role_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);

-- Permission-Role relationship
CREATE TABLE permission_role (
    permission_id BIGINT UNSIGNED,
    role_id BIGINT UNSIGNED,
    PRIMARY KEY (permission_id, role_id),
    FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);
```

## Best Practices

### 1. Permission Naming Convention
- Use lowercase with underscores: `manage_users`, `view_reports`
- Be descriptive: `manage_shipments` vs `edit_shipments`
- Group related permissions: `user_create`, `user_edit`, `user_delete`

### 2. Role Hierarchy
- `super_admin`: Full system access
- `admin`: Tenant admin with most permissions
- `manager`: Department manager with limited permissions
- `user`: Regular user with basic permissions

### 3. Security Considerations
- Always check permissions on both client and server side
- Use middleware for route protection
- Check permissions in controllers before processing requests
- Log permission violations for security monitoring

### 4. Performance Optimization
- Cache user permissions if possible
- Use eager loading for roles and permissions
- Avoid checking permissions in loops when possible

## Common Permission Patterns

### User Management
```php
'manage_users'     // Full user CRUD
'create_users'     // Only create users
'edit_users'       // Only edit users
'delete_users'     // Only delete users
'view_users'       // Only view users
```

### Content Management
```php
'manage_content'   // Full content CRUD
'publish_content'  // Publish content
'edit_own_content' // Edit only own content
'edit_all_content' // Edit any content
```

### Reporting
```php
'view_reports'     // View basic reports
'view_advanced_reports' // View detailed reports
'export_reports'   // Export report data
'manage_reports'   // Full report management
```

## Testing Permissions

```php
// In your test files
public function test_user_cannot_access_admin_routes_without_permission()
{
    $user = User::factory()->create(['role' => 'user']);

    // Assign limited permissions
    $role = Role::create(['name' => 'limited_user']);
    $permission = Permission::create(['name' => 'view_basic']);
    $role->permissions()->attach($permission);
    $user->roles()->attach($role);

    $this->actingAs($user);

    // Should be denied
    $response = $this->get('/admin/users');
    $response->assertStatus(403);

    // Should be allowed
    $response = $this->get('/dashboard');
    $response->assertStatus(200);
}
```

## Troubleshooting

### Common Issues

1. **Permission not working**: Check if user has the role that contains the permission
2. **Blade directive not working**: Ensure PermissionServiceProvider is registered
3. **Middleware not working**: Check middleware registration in bootstrap/app.php
4. **Database issues**: Verify pivot tables are properly set up

### Debug Commands

```bash
# Check user permissions
php artisan tinker
>>> $user = App\Models\User::find(1);
>>> $user->hasPermission('manage_users');

# Clear cache
php artisan config:clear
php artisan view:clear
php artisan route:clear
```