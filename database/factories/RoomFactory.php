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
            'name' => $this->faker->word, // اسم عشوائي
            'description' => $this->faker->sentence, // وصف عشوائي
            'image' => $this->faker->imageUrl(640, 480, 'rooms', true), // صورة عشوائية
            'price' => $this->faker->numberBetween(50, 500), // سعر عشوائي بين 50 و 500
            'room_type' => $this->faker->randomElement(['single', 'double', 'suite']), // نوع عشوائي
            'capacity' => $this->faker->numberBetween(1, 5),
        ];
    }
}
