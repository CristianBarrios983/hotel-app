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
        Schema::create('tipos_habitacion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_tipo'); // Nombre del tipo de habitación (Ej. Suite, Estándar)
            $table->string('descripcion')->nullable(); // Descripción opcional del tipo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_habitacion');
    }
};
