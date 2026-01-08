<?php

namespace Database\Seeders;

use App\Models\Vendedor;
use Illuminate\Database\Seeder;

class VendedorSeeder extends Seeder
{
    public function run(): void
    {
        // Crear 100 vendedores
        Vendedor::factory(100)->create();

        $this->command->info('✅ 100 vendedores creados');
    }
}
