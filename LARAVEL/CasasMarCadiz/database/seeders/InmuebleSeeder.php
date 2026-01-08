<?php

namespace Database\Seeders;

use App\Models\Inmueble;
use App\Models\Vendedor;
use Illuminate\Database\Seeder;

class InmuebleSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener vendedores existentes
        $vendedores = Vendedor::all();

        if ($vendedores->isEmpty()) {
            $this->command->error('❌ No hay vendedores. Ejecuta VendedorSeeder primero.');
            return;
        }

        // Crear 100 inmuebles asignados a vendedores existentes
        Inmueble::factory(100)->create([
            'vendedor_id' => fn() => $vendedores->random()->id,
        ]);

        $this->command->info('✅ 100 inmuebles creados');
    }
}
