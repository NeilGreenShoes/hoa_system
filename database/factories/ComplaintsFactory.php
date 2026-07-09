<?php

namespace Database\Factories;

use App\Models\Complaints;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Complaints>
 */
class ComplaintsFactory extends Factory
{
    protected $model = Complaints::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $category = fake()->randomElement([
            'Facilities',
            'Safety',
            'Noise',
            'Neighbors',
            'Garbage',
            'Parking',
            'Security',
            'Water',
            'Road',
            'Others',
        ]);

        return [
            'title' => match ($category) {
                'Facilities' => 'Broken Streetlight',
                'Safety' => 'Suspicious Individual',
                'Noise' => 'Excessive Noise at Night',
                'Neighbors' => 'Neighbor Dispute',
                'Garbage' => 'Garbage Not Collected',
                'Parking' => 'Unauthorized Parking',
                'Security' => 'Open Main Gate',
                'Water' => 'Water Leakage',
                'Road' => 'Pothole on Main Road',
                default => 'General Complaint',
            },

            'category' => $category,

            'description' => fake()->paragraph(3),

            'attachedFile' => fake()->randomElement([
                'complaints/photo1.jpg',
                'complaints/photo2.jpg',
                'complaints/photo3.jpg',
                'complaints/photo4.jpg',
                null,
            ]),

            'severityLevel' => fake()->randomElement([
                'Low', 'Medium', 'High'
            ]),

            'submitDate' => fake()->dateTimeBetween('-2 months', 'now')->format('Y-m-d'),

            'status' => fake()->randomElement([
                'Pending','Acknowledged','Resolved'
            ]),

            'membershipID' => null, // Set in DashboardSeeder
            'staffID' => null,      // Set in DashboardSeeder

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
