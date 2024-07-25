<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Motor>
 */
class MotorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Masukan database property Motor yang akan dibuat di MotorFactory
        return [
            'nama_motor' => $this->faker->sentence(2),
            'merek_id' => $this->faker->numberBetween(1, 3),
            'warna' => $this->faker->colorName(),
            'harga' => $this->faker->numberBetween(1000, 2000),
            'image' => $this->faker->image(null, 640, 480)
        ];
    }
}
