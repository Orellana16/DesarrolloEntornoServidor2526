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
        Schema::create('inmueble_comprador', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comprador_id')->constrained('comprador')->onUpdate('cascade');
            $table->foreignId('inmueble_id')->constrained('inmueble')->onUpdate('cascade');
            $table->integer('comision');
            $table->dateTime('fecha_com');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inmueble_comprador');
    }
};
