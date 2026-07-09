<?php

namespace Database\Factories;

use App\Models\Maintenance;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Maintenance>
 */
class MaintenanceFactory extends Factory
{
    protected $model = Maintenance::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $category = fake()->randomElement([
            'Road',
            'Drainage',
            'Street Lights',
            'Water System',
            'Park',
            'Clubhouse',
            'Electrical',
            'Security',
            'Landscaping',
            'Others',
        ]);

        return [
            'title' => match ($category) {
                'Road' => 'Road Repair Request',
                'Drainage' => 'Drainage Cleaning',
                'Street Lights' => 'Street Light Replacement',
                'Water System' => 'Water Pipeline Leak',
                'Park' => 'Playground Equipment Repair',
                'Clubhouse' => 'Clubhouse Ceiling Repair',
                'Electrical' => 'Electrical Wiring Inspection',
                'Security' => 'CCTV Maintenance',
                'Landscaping' => 'Tree Trimming Request',
                default => 'General Maintenance Request',
            },

            'category' => $category,

            'description' => fake()->paragraph(3),

            'attachedFile' => fake()->randomElement([
                'maintenance/photo1.jpg',
                'maintenance/photo2.jpg',
                'maintenance/photo3.jpg',
                'maintenance/photo4.jpg',
                null,
            ]),

            'requestDate' => fake()
                ->dateTimeBetween('-2 months', 'now')
                ->format('Y-m-d'),

            'status' => fake()->randomElement([
                'Pending', 'Acknowledged', 'Completed'
            ]),

            // Assigned in DashboardSeeder
            'membershipID' => null,
            'staffID' => null,

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
