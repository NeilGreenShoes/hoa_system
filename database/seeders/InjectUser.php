<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class InjectUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['loginEmail' => 'demilight77@gmail.com'],
            [
                'password'    => Hash::make('qwertyuiop'),
                'status'      => 'Active',
                'isLoggedIn'  => false,
                'lastSession' => null,
                'roleID'      => 1,
            ]
        );
    }
}
