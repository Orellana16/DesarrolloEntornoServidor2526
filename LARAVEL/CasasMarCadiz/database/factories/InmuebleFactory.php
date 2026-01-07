<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class InmuebleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->city(),
            'precio' => fake()->randomFloat(min: 25000, max: 1000000),
            'direccion' => fake()->address(),
            'metros' => fake()->numberBetween(25, 100000),
            'vendedor_id' => User::factory(),

        ];
    }
}
