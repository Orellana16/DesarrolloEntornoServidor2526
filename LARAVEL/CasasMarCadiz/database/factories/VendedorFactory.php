<?php

namespace Database\Factories;

use App\Models\Vendedor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory para generar vendedores ficticios
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendedor>
 */
class VendedorFactory extends Factory
{
    protected $model = Vendedor::class;

    public function definition(): array
    {
        $sexo = fake()->randomElement(['M', 'F']);

        return [
            'nombre' => fake()->name($sexo === 'M' ? 'male' : 'female'),

            'nif' => fake()->unique()->regexify('[0-9]{8}[A-Z]'),

            // Vendedores entre 21 y 65 años (edad laboral)
            'fecha_nac' => fake()->dateTimeBetween('-65 years', '-21 years')->format('Y-m-d'),

            'sexo' => $sexo,

            // Sintaxis correcta: randomFloat(decimales, min, max)
            'sueldo_base' => fake()->randomFloat(2, 15000, 80000),
        ];
    }

    /**
     * Estado: Vendedor senior (sueldo alto)
     */
    public function senior(): static
    {
        return $this->state(fn(array $attributes) => [
            'sueldo_base' => fake()->randomFloat(2, 60000, 120000),
        ]);
    }
}
