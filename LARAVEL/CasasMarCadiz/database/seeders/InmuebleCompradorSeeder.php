<?php

namespace Database\Seeders;

use App\Models\Comprador;
use App\Models\Inmueble;
use App\Models\InmuebleComprador;
use Illuminate\Database\Seeder;

class InmuebleCompradorSeeder extends Seeder
{
    public function run(): void
    {
        $compradores = Comprador::all();
        $inmuebles = Inmueble::all();

        if ($compradores->isEmpty() || $inmuebles->isEmpty()) {
            $this->command->error('❌ Necesitas compradores e inmuebles primero.');
            return;
        }

        // Crear 100 transacciones de compra

        InmuebleComprador::factory(100)->create([
            'comprador_id' => $compradores->random()->id,
            'inmueble_id' => $inmuebles->random()->id,
        ]);

        $this->command->info('✅ 100 transacciones creadas');
    }
}
