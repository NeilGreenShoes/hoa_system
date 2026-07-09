<?php

namespace Database\Factories;

use App\Models\Houselots;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Houselots>
 */
class HouselotsFactory extends Factory
{
    protected $model = Houselots::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'lotNumber' => fake()->unique()->numberBetween(1, 500),

            'blockNumber' => fake()->numberBetween(1, 20),

            'homeownerID' => null,

            'occupancyStatus' => fake()->randomElement([
                'Vacant','Occupied','For Rent','Under Construction'
            ]),

            'lastVerifiedDate' => fake()
                ->dateTimeBetween('-6 months', 'now')
                ->format('Y-m-d'),

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
