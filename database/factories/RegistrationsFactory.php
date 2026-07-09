<?php

namespace Database\Factories;

use App\Models\Registrations;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Registrations>
 */
class RegistrationsFactory extends Factory
{
    protected $model = Registrations::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'registrationType' => fake()->randomElement([
                'Online',
                'Walk-in',
            ]),

            'membershipFee' => fake()->randomElement([
                1000.00,
                1500.00,
                2000.00,
            ]),

            'validIDImage' => fake()->randomElement([
                'documents/ids/id1.jpg',
                'documents/ids/id2.jpg',
                'documents/ids/id3.jpg',
            ]),

            'lotDocument' => fake()->randomElement([
                'documents/lots/title1.pdf',
                'documents/lots/title2.pdf',
                'documents/lots/title3.pdf',
            ]),

            'registrationDate' => fake()
                ->dateTimeBetween('-1 year', 'now')
                ->format('Y-m-d'),

            'status' => fake()->randomElement([
                'Pending',
                'Approved',
                'Rejected',
            ]),

            'remark' => fake()->randomElement([
                'Documents verified.',
                'Pending document verification.',
                'Approved by HOA staff.',
                'Awaiting homeowner confirmation.',
                'Registration completed successfully.',
            ]),

            'homeownerID' => null,
            'houseLotID' => null,
            'userID' => null,
            'staffID' => null,
            'billingID' => null,

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
