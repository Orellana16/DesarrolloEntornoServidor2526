<?php

namespace Database\Factories;

use App\Models\Comprador;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory para generar compradores ficticios
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comprador>
 */
class CompradorFactory extends Factory
{
    // Especificamos el modelo explícitamente
    protected $model = Comprador::class;

    /**
     * Define el estado por defecto del modelo
     */
    public function definition(): array
    {
        // Generamos el sexo primero para usarlo en el nombre
        $sexo = fake()->randomElement(['M', 'F']);

        return [
            // Nombre coherente con el sexo
            'nombre' => fake()->name($sexo === 'M' ? 'male' : 'female'),

            // NIF español válido (8 números + 1 letra)
            'nif' => fake()->unique()->regexify('[0-9]{8}[A-Z]'),

            // Fecha entre 18 y 80 años atrás (compradores adultos)
            'fecha_nac' => fake()->dateTimeBetween('-80 years', '-18 years')->format('Y-m-d'),

            'sexo' => $sexo,
        ];
    }

    /**
     * Estado: Comprador joven (18-30 años)
     */
    public function joven(): static
    {
        return $this->state(fn(array $attributes) => [
            'fecha_nac' => fake()->dateTimeBetween('-30 years', '-18 years')->format('Y-m-d'),
        ]);
    }
}
