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
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('habitacion_id')->nullable();
            $table->text('descripcion')->nullable();
            $table->enum('estado', ['Pendiente', 'En Proceso', 'Completado'])->default('Pendiente');
            $table->enum('prioridad', ['Alta', 'Media', 'Baja'])->default('Media');
            $table->string('personal')->nullable();  // Cambiado a string por ahora
            $table->date('fecha_completado')->nullable();
            $table->timestamps();  // Este crea created_at y updated_at

            // Foreign Key solo para habitaciones
            $table->foreign('habitacion_id')->references('id')->on('habitaciones')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenimientos');
    }
};
