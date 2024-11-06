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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_proveedor');
            $table->string('telefono', 15); // Limite de longitud para teléfono
            $table->string('email')->unique();
            $table->string('direccion', 255); // Limite de longitud para dirección
            $table->string('descripcion')->nullable(); // Opcional si corresponde
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->timestamps();

            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
