<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Roles used in the project
        $roles = [
            'super_admin',
            'admin',
            'branch_manager',
            'booking_executive',
            'accounts_user',
            'fleet_manager',
            'vendor_manager',
            'viewer',
            'user'
        ];

        foreach ($roles as $r) {
            Role::firstOrCreate(['name' => $r]);
        }

        // Example permissions (expand as needed)
        $perms = [
            'manage users',
            'manage shipments',
            'view reports'
        ];

        foreach ($perms as $p) {
            Permission::firstOrCreate(['name' => $p]);
        }

        // Attach some example permissions to admin roles
        $admin = Role::where('name', 'admin')->first();
        if ($admin) {
            $permIds = Permission::whereIn('name', $perms)->pluck('id')->toArray();
            $admin->permissions()->syncWithoutDetaching($permIds);
        }

        $super = Role::where('name', 'super_admin')->first();
        if ($super) {
            $super->permissions()->syncWithoutDetaching(Permission::pluck('id')->toArray());
        }

        // Create a default admin user for testing
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Test Admin',
                'phone' => '1234567890',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'status' => 1,
                'phone_verified' => true,
                'email_verified' => true,
            ]
        );

        // Assign admin role to the test user
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $adminUser->syncRoles(['admin']);
        }
    }
}
