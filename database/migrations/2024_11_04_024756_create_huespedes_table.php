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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); 
            $table->string('nombre'); // Nombre del usuario
            $table->string('apellido'); // Apellido del usuario
            $table->date('fecha_nacimiento'); // Fecha de nacimiento
            $table->string('nacionalidad'); // Nacionalidad
            $table->string('tipo_documento'); // Tipo de documento
            $table->string('numero_documento')->unique(); // Número de documento
            $table->string('email')->unique(); // Email
            $table->string('telefono'); // Teléfono
            $table->timestamps(); // Campos de fecha de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('huespedes');
    }
};
