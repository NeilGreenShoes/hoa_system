<?php

namespace Database\Factories;

use App\Models\Payments;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payments>
 */
class PaymentsFactory extends Factory
{
    protected $model = Payments::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'amount' => fake()->randomFloat(2, 300, 3000),

            'discount' => fake()->randomElement([
                0.00,
                50.00,
                100.00,
                200.00,
            ]),

            'paymentDate' => fake()
                ->dateTimeBetween('-2 months', 'now')
                ->format('Y-m-d'),

            // Set these in the DashboardSeeder
            'paymentMethodID' => null,
            'billingID' => null,
            'staffID' => null,

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
