<?php

namespace Database\Factories;

use App\Models\WaterReading;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WaterReading>
 */
class WaterReadingFactory extends Factory
{
    protected $model = WaterReading::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $previousReading = fake()->numberBetween(50, 500);
        $consumption = fake()->numberBetween(5, 40);
        $currentReading = $previousReading + $consumption;
        $ratePerCubic = 15;

        return [
            'previousReading' => $previousReading,
            'currentReading' => $currentReading,
            'consumption' => $consumption,
            'readingImage' => fake()->randomElement([
                'readings/meter1.jpg',
                'readings/meter2.jpg',
                'readings/meter3.jpg',
                'readings/meter4.jpg',
            ]),
            'readingDate' => fake()
                ->dateTimeBetween('-2 months', 'now')
                ->format('Y-m-d'),

            'amount' => $consumption * $ratePerCubic,

            // Set in DashboardSeeder
            'membershipID' => null,
            'staffID' => null,

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
