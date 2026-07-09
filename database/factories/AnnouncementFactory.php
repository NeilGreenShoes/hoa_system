<?php

namespace Database\Factories;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnouncementFactory extends Factory
{
    protected $model = Announcement::class;

    public function definition(): array
    {
        $targetType = $this->faker->randomElement([
            'All',
            'Block',
            'Homeowner',
        ]);

        $targetReference = match ($targetType) {
            'All' => 'General',
            'Block' => 'Block ' . $this->faker->numberBetween(1, 10),
            'Homeowner' => 'Homeowner #' . $this->faker->numberBetween(1, 20),
        };

        return [
            'title' => $this->faker->randomElement([
                'Monthly Homeowners Meeting',
                'Water Service Interruption',
                'Community Clean-Up Drive',
                'Road Repair Notice',
                'Security Advisory',
                'Garbage Collection Schedule',
                'Tree Trimming Activity',
                'Power Interruption Notice',
                'Subdivision Fiesta',
                'Sports Tournament',
            ]) . ' #' . $this->faker->numberBetween(1, 9999),

            'description' => $this->faker->paragraph(3),

            'targetType' => $targetType,
            'targetReference' => $targetReference,

            'datePosted' => $this->faker->date(),

            'staffID' => null,

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}