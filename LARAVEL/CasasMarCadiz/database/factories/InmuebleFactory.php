<?php

namespace Database\Factories;

use App\Models\Inmueble;
use App\Models\Vendedor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory para generar inmuebles ficticios
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inmueble>
 */
class InmuebleFactory extends Factory
{
    protected $model = Inmueble::class;

    public function definition(): array
    {

        $city = fake()->city();
        return [
            // Tipo de inmueble más descriptivo
            'nombre' => fake()->randomElement([
                'Piso',
                'Apartamento',
                'Chalet',
                'Dúplex',
                'Ático',
                'Casa',
                'Estudio',
                'Loft'
            ]) . ' en ' . $city,

            // Sintaxis correcta de randomFloat
            'precio' => fake()->randomFloat(2, 50000, 1000000),

            'direccion' => fake()->streetAddress() . ', ' . $city,

            // Metros más realistas según tipo
            'metros' => fake()->numberBetween(30, 500),

            'vendedor_id' => Vendedor::factory(),
        ];
    }

    /**
     * Estado: Inmueble de lujo
     */
    public function lujo(): static
    {
        return $this->state(fn(array $attributes) => [
            'precio' => fake()->randomFloat(2, 500000, 5000000),
            'metros' => fake()->numberBetween(200, 1000),
        ]);
    }
}
