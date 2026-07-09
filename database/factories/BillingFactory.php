<?php

namespace Database\Factories;

use App\Models\Billing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Billing>
 */
class BillingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     protected $model = Billing::class;
    public function definition(): array
    {
        $monthlyDue = 500.00;
        $securityFee = 200.00;
        $penaltyFee = fake()->randomElement([0, 50, 100]);
        $reconnectionFee = fake()->randomElement([0, 150]);
        $arrears = fake()->randomElement([0, 100, 200, 300]);

        $totalAmount = $monthlyDue
            + $securityFee
            + $penaltyFee
            + $reconnectionFee
            + $arrears;

        return [
            'billingDate' => fake()->date(),
            'dueDate' => fake()->dateTimeBetween('+7 days', '+30 days')->format('Y-m-d'),

            'monthlyDue' => $monthlyDue,
            'securityFee' => $securityFee,
            'penaltyFee' => $penaltyFee,
            'reconnectionFee' => $reconnectionFee,
            'arrears' => $arrears,
            'totalAmount' => $totalAmount,

            'status' => fake()->randomElement([
                'Pending',
                'Paid',
                'Overdue',
                'Partially Paid',
            ]),

            'seniorDiscountEligible' => fake()->boolean(),

            // These will be supplied in the seeder
            'waterReadingID' => null,
            'membershipID' => null,
            'staffID' => null,

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
