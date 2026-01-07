<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CompradorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->name('male'),
            'nif' => fake()->uniqid(),
            'fecha_nac' => fake()->date(),
            'sexo' => rand(10) > 5 ? 'M' : 'F',
        ];
    }
}
