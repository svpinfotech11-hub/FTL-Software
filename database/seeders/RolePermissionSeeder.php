<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('permission_role')->truncate();
        DB::table('role_user')->truncate();
        Permission::truncate();
        Role::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

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
        // $perms = [
        //     'manage users',
        //     'view shipments',
        //     'create shipments',
        //     'edit shipments',
        //     'delete shipments',
        //     'view reports',
        //     'create vendors',
        //     'view vendors',
        //     'create customers',
        //     'view customers',
        //     'create vehicles',
        //     'create companies',
        //     'manage vehicle hires',
        //     'manage expenses',
        //     'manage vehicles',
        //     'manage drivers',
        //     'manage branches',
        //     'manage roles',
        //     'manage permissions',
        //     'manage companies'
        // ];

        $perms = [
            // User Management
            'user.create',
            'user.store',
            'user.view',
            'user.edit',
            'user.delete',

            // Shipments (Domestic)
            'manage.shipments',
            'create.shipments',
            'edit.shipments',
            'delete.shipments',
            'view shipments',
            'pod.shipments',

            // Vendors
            'manage.vendors',
            'create.vendors',
            'edit.vendors',
            'delete.vendors',
            'view.vendors',

            // Customers
            'manage.customers',
            'create.customers',
            'edit.customers',
            'delete.customers',
            'view.customers',

            // Vehicles
            'manage.vehicles',
            'create.vehicles',
            'edit.vehicles',
            'delete.vehicles',
            'view.vehicles',

            // Branches
            'manage.branches', // create, edit, delete, view
            'create.branches',
            'edit.branches',
            'delete.branches',
            'view.branches',

            // Drivers
            'manage.drivers', // create, edit, delete, view
            'create.drivers',
            'edit.drivers',
            'delete.drivers',
            'view.drivers',

            // Companies
            'manage.companies',
            'create.companies',
            'edit.companies',
            'delete.companies',
            'view.companies',

            // Vehicle Hires
            'manage.vehicle_hires', // create, edit, delete, view
            'create.vehicle_hires',
            'edit.vehicle_hires',
            'delete.vehicle_hires',
            'view.vehicle_hires',

            // Expenses
            'manage.expense', // create, edit, delete, view
            'create.expense',
            'edit.expense',
            'delete.expense',
            'view.expense',

            // Reports (general)
            'report.view', // view any kind of reports
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
