<?php

namespace Database\Factories;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Staff>
 */
class StaffFactory extends Factory
{
    protected $model = Staff::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['Male', 'Female']);

        return [
            'lastName' => fake()->lastName(),

            'firstName' => $gender === 'Male'
                ? fake()->firstNameMale()
                : fake()->firstNameFemale(),

            'middleName' => fake()->firstName(),

            'dateOfBirth' => fake()
                ->dateTimeBetween('-60 years', '-21 years')
                ->format('Y-m-d'),

            'gender' => $gender,

            'maritalStatus' => fake()->randomElement([
                'Single',
                'Married',
                'Widowed',
                'Separated',
            ]),

            'contactNumber' => '09' . fake()->numerify('#########'),

            'email' => fake()->unique()->safeEmail(),

            'profileImage' => 'profiles/default-staff.png',

            // Set in DashboardSeeder
            'userID' => null,
            'addressID' => null,

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
