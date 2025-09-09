<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->randomElement(['Deluxe Room','Superior Room','Suite','Standard Room']),
            'capacity' => $this->faker->numberBetween(1, 6),
            'price_per_night' => $this->faker->randomElement([89.00, 129.00, 159.00, 199.00]),
            'image_url' => 'https://picsum.photos/seed/'.uniqid().'/800/600',
            'description' => $this->faker->paragraph(),
        ];
    }
}
