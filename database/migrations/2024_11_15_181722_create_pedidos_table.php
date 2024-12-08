<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proveedor_id')->nullable();
            $table->date('fecha_entrega')->nullable();
            $table->string('estado_pedido'); 
            $table->decimal('total', 10, 2);

            $table->foreign('proveedor_id')
                  ->references('id')->on('proveedores')
                  ->onDelete('set null'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}

