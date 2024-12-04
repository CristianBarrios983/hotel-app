<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Actualizamos todos los valores existentes a minúsculas
        DB::statement("UPDATE habitaciones SET disponibilidad = LOWER(disponibilidad)");
        
        // Luego modificamos la columna
        Schema::table('habitaciones', function (Blueprint $table) {
            $table->dropColumn('disponibilidad');
        });
        
        Schema::table('habitaciones', function (Blueprint $table) {
            $table->enum('disponibilidad', ['disponible', 'reservada', 'ocupada', 'mantenimiento'])->default('disponible');
        });
    }

    public function down(): void
    {
        // Revertir los cambios
        Schema::table('habitaciones', function (Blueprint $table) {
            $table->dropColumn('disponibilidad');
        });
        
        Schema::table('habitaciones', function (Blueprint $table) {
            $table->enum('disponibilidad', ['Disponible', 'Reservada', 'Ocupada', 'Mantenimiento'])->default('Disponible');
        });
    }
};