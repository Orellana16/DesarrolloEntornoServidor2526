<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Campos para Geo-localización en usuarios
        Schema::table('users', function (Blueprint $table) {
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->string('address')->nullable();
        });

        // 2. Vincular Vendedores al Usuario (Si no lo tienes ya)
        Schema::table('vendedor', function (Blueprint $table) {
            // Si ya tienes user_id, borra esta línea
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendedor', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
};
