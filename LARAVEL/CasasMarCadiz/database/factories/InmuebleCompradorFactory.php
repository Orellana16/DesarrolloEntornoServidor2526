<?php

namespace Database\Factories;

use App\Models\Comprador;
use App\Models\Inmueble;
use App\Models\InmuebleComprador;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory para la tabla pivote inmueble_comprador (ventas/transacciones)
 */
class InmuebleCompradorFactory extends Factory
{
    protected $model = InmuebleComprador::class;

    public function definition(): array
    {
        return [
            'comprador_id' => Comprador::factory(),
            'inmueble_id' => Inmueble::factory(),

            // Comisión entre 1% y 10%
            'comision' => fake()->numberBetween(1, 10),

            // Fecha de compra en los últimos 2 años
            'fecha_com' => fake()->dateTimeBetween('-2 years', 'now'),
        ];
    }
}
