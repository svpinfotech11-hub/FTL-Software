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
            'shipment.create',
            'shipment.view',
            'shipment.edit',
            'shipment.delete',
            'shipment.report',
            'shipment.print',

            // Vendors
            'vendor.manage',
            'vendor.create',
            'vendor.view',
            'vendor.edit',
            'vendor.delete',

            // Customers
            'customer.manage',
            'customer.create',
            'customer.view',
            'customer.edit',
            'customer.delete',

            // Vehicles
            'vehicle.manage',
            'vehicle.create',
            'vehicle.view',
            'vehicle.edit',
            'vehicle.delete',

            // Branches
            'branch.manage', // create, edit, delete, view
            'branch.create',
            'branch.view',
            'branch.edit',
            'branch.delete',

            // Drivers
            'driver.manage', // create, edit, delete, view
            'driver.create',
            'driver.view',
            'driver.edit',
            'driver.delete',

            // Companies
            'company.manage',
            'company.create',
            'company.view',
            'company.edit',
            'company.delete',

            // Vehicle Hires
            'vehicle_hire.manage', // create, edit, delete, view
            'vehicle_hire.create',
            'vehicle_hire.view',
            'vehicle_hire.edit',
            'vehicle_hire.delete',

            // Expenses
            'expense.manage', // create, edit, delete, view
            'expense.create',
            'expense.view',
            'expense.edit',
            'expense.delete',

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
