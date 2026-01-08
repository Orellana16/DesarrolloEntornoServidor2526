<?php

namespace Database\Seeders;

use App\Models\Comprador;
use Illuminate\Database\Seeder;

class CompradorSeeder extends Seeder
{
    public function run(): void
    {
        // Crear 100 compradores
        Comprador::factory(100)->create();

        $this->command->info('✅ 100 compradores creados');
    }
}
