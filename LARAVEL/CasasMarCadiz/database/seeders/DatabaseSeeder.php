<?php

/***********************************************
 * 
 * 
 * # OPCIÓN 1: Ejecutar todo (migraciones + seeders)
# ════════════════════════════════════════════════════════════════
php artisan migrate:fresh --seed

# ════════════════════════════════════════════════════════════════
# OPCIÓN 2: Solo seeders (si ya tienes las tablas)
# ════════════════════════════════════════════════════════════════
php artisan db:seed

# ════════════════════════════════════════════════════════════════
# OPCIÓN 3: Seeders individuales
# ════════════════════════════════════════════════════════════════
php artisan db:seed --class=VendedorSeeder
php artisan db:seed --class=CompradorSeeder
php artisan db:seed --class=InmuebleSeeder
php artisan db:seed --class=InmuebleCompradorSeeder

# ════════════════════════════════════════════════════════════════
# OPCIÓN 4: Crear seeders desde cero (si no existen)
# ════════════════════════════════════════════════════════════════
php artisan make:seeder VendedorSeeder
php artisan make:seeder CompradorSeeder
php artisan make:seeder InmuebleSeeder
php artisan make:seeder InmuebleCompradorSeeder
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Ejecuta todos los seeders en orden correcto
     */
    public function run(): void
    {
        $this->command->info('🚀 Iniciando seeders...');
        $this->command->newLine();

        // ⚠️ ORDEN IMPORTANTE por las foreign keys
        $this->call([
            VendedorSeeder::class,          // 1. Primero vendedores
            CompradorSeeder::class,          // 2. Compradores (independiente)
            InmuebleSeeder::class,           // 3. Inmuebles (necesita vendedores)
            InmuebleCompradorSeeder::class,  // 4. Transacciones (necesita ambos)
        ]);

        $this->command->newLine();
        $this->command->info('🎉 ¡Todos los seeders completados!');
    }
}
