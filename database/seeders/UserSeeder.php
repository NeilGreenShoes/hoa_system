<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['roleID' => 1], ['roleName' => 'Admin']);
        $userRole  = Role::firstOrCreate(['roleID' => 2], ['roleName' => 'User']);

        User::updateOrCreate(
            ['loginEmail' => 'admin@example.com'],
            [
                'password'    => Hash::make('password123'),
                'status'      => 'active',
                'isLoggedIn'  => false,
                'lastSession' => null,
                'roleID'      => $adminRole->roleID,
            ]
        );

        User::factory()->count(10)->create([
            'roleID' => $userRole->roleID,
        ]);
    }
}
