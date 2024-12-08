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
        Schema::create('configuracion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_hotel')->unique();
            $table->string('razon_social')->unique();
            $table->string('cuit', 13)->unique();
            $table->string('correo')->unique();
            $table->string('telefono');
            $table->string('direccion');
            $table->string('sitio_web');
            $table->text('otros_detalles')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracion');
    }
};
