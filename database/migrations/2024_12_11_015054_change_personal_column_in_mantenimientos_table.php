<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePersonalColumnInMantenimientosTable extends Migration
{
    public function up()
    {
        Schema::table('mantenimientos', function (Blueprint $table) {
            // Cambiar el tipo de la columna 'personal' a unsignedBigInteger
            $table->unsignedBigInteger('personal_id')->nullable()->after('prioridad'); // Cambia el nombre a 'personal_id'
            $table->dropColumn('personal'); // Eliminar la columna original

            // Agregar la relación de clave foránea
            $table->foreign('personal_id')->references('id')->on('users')->onDelete('set null'); 
        });
    }

    public function down()
    {
        Schema::table('mantenimientos', function (Blueprint $table) {
            // Volver a agregar la columna 'personal' como string
            $table->string('personal')->nullable()->after('prioridad');
            $table->dropForeign(['personal_id']); // Eliminar la relación de clave foránea
            $table->dropColumn('personal_id'); // Eliminar la columna 'personal_id'
        });
    }
}
