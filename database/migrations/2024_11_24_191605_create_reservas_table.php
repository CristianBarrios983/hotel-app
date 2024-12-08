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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('habitacion_id')->nullable();
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->unsignedBigInteger('huesped_id')->nullable();
            $table->dateTime('check_in');
            $table->dateTime('check_out');
            $table->enum('estado', ['pendiente', 'confirmada', 'check_in', 'check_out', 'cancelada', 'no_show']);
            $table->text('observaciones')->nullable();
            $table->timestamps();

            $table->foreign('habitacion_id')->references('id')->on('habitaciones')->onDelete('set null');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('huesped_id')->references('id')->on('huespedes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
