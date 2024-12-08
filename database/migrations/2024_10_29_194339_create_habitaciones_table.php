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
    Schema::create('habitaciones', function (Blueprint $table) {
        $table->id();
        $table->string('numero_habitacion')->unique();
        $table->unsignedBigInteger('capacidad');
        $table->decimal('tamano', 8, 2); // Tamaño en m²
        $table->string('vistas')->nullable();
        $table->string('tipo_cama'); // Cambia a string para lista desplegable
        $table->decimal('precio_por_noche', 10, 2);
        $table->string('disponibilidad')->default('disponible');
        $table->unsignedBigInteger('tipo_habitacion_id')->nullable();
        $table->unsignedBigInteger('piso_id')->nullable();
        $table->timestamps();

        $table->foreign('tipo_habitacion_id')->references('id')->on('tipos_habitacion')->onDelete('set null');
        $table->foreign('piso_id')->references('id')->on('pisos')->onDelete('set null');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habitaciones');
    }
};
