<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'loginEmail'  => $this->faker->unique()->safeEmail(),
            'password'    => Hash::make('password'), 
            'status'      => 'active',
            'isLoggedIn'  => false,
            'lastSession' => null,
            'roleID'      => Role::pluck('roleID')->first() ?? 1, 
        ];
    }
}
