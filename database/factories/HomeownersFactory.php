<?php

namespace Database\Factories;

use App\Models\Homeowners;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Homeowners>
 */
class HomeownersFactory extends Factory
{
     protected $model = Homeowners::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['Male', 'Female']);
        $firstName = fake()->firstName($gender === 'Male' ? 'male' : 'female');
        $middleName = fake()->firstName();
        $lastName = fake()->lastName();

        return [
            'firstName' => $firstName,
            'middleName' => $middleName,
            'lastName' => $lastName,
            'dateOfBirth' => fake()->dateTimeBetween('-70 years', '-18 years')->format('Y-m-d'),
            'gender' => $gender,
            'religion' => fake()->randomElement([
                'Roman Catholic',
                'Christian',
                'Islam',
                'Iglesia ni Cristo',
                'Seventh-day Adventist',
            ]),
            'maritalStatus' => fake()->randomElement([
                'Single',
                'Married',
                'Widowed',
                'Separated',
            ]),
            'contactNumber' => '09' . fake()->numerify('#########'),
            'email' => fake()->unique()->safeEmail(),
            'profileImage' => 'profiles/default-profile.png',

            // Assigned in DashboardSeeder
            'userID' => null,
            'addressID' => null,

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
