<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name'     => 'Super Admin',
                'password' => Hash::make('Admin@123'),
                'role'     => 'superadmin',
                'status'   => 1,
                'city'    => 'thane',
                'state'    => 'goa',
                'country'    => 'india',
                'phone'    => '9988998899',
            ]
        );
    }
}
