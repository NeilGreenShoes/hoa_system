<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     protected $model = Address::class;
    public function definition(): array
    {
        return [
            'street' =>  fake()->streetName() . ' St.',
            'barangay' => fake()->randomElement([
                'San Isidro',
                'Central',
                'Mintal',
                'Buhangin',
                'Catalunan Grande',
                'Catalunan Pequeño',
                'Talomo',
                'Matina',
                'Agdao',
                'Toril',
            ]),
            'city' => 'Davao City',
            'province' => 'Davao del Sur',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
