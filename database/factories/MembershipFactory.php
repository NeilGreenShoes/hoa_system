<?php

namespace Database\Factories;

use App\Models\Membership;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Membership>
 */
class MembershipFactory extends Factory
{
    protected $model = Membership::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('-3 years', '-1 month');

        return [
            'membershipStartDate' => $startDate->format('Y-m-d'),

            'memberShipEndDate' => fake()->optional(0.2)
                ->dateTimeBetween('now', '+2 years')
                ?->format('Y-m-d'),

            'status' => fake()->randomElement([
                'Active',
                'Inactive',
            ]),

            // Assigned in DashboardSeeder
            'homeownerID' => null,
            'houseLotID' => null,
            'registrationID' => null,

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
