<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Primero actualizamos los datos existentes
        DB::table('mantenimientos')->where('estado', 'Pendiente')->update(['estado' => 'pendiente']);
        DB::table('mantenimientos')->where('estado', 'En Proceso')->update(['estado' => 'en_proceso']);
        DB::table('mantenimientos')->where('estado', 'Completado')->update(['estado' => 'completado']);
        
        // Luego modificamos la columna
        Schema::table('mantenimientos', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
        
        Schema::table('mantenimientos', function (Blueprint $table) {
            $table->enum('estado', ['pendiente', 'en_proceso', 'completado'])->default('pendiente');
        });

        // Lo mismo para prioridad
        DB::table('mantenimientos')->where('prioridad', 'Alta')->update(['prioridad' => 'alta']);
        DB::table('mantenimientos')->where('prioridad', 'Media')->update(['prioridad' => 'media']);
        DB::table('mantenimientos')->where('prioridad', 'Baja')->update(['prioridad' => 'baja']);
        
        Schema::table('mantenimientos', function (Blueprint $table) {
            $table->dropColumn('prioridad');
        });
        
        Schema::table('mantenimientos', function (Blueprint $table) {
            $table->enum('prioridad', ['alta', 'media', 'baja'])->default('media');
        });
    }

    public function down(): void
    {
        // Revertir los cambios
        Schema::table('mantenimientos', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
        
        Schema::table('mantenimientos', function (Blueprint $table) {
            $table->enum('estado', ['Pendiente', 'En Proceso', 'Completado'])->default('Pendiente');
        });

        Schema::table('mantenimientos', function (Blueprint $table) {
            $table->dropColumn('prioridad');
        });
        
        Schema::table('mantenimientos', function (Blueprint $table) {
            $table->enum('prioridad', ['Alta', 'Media', 'Baja'])->default('Media');
        });
    }
};