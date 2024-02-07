<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyVentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::table('ventas', function (Blueprint $table) {
            $table->foreign('cliente_id')->references('id')->on('cliente')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('venta_id')->references('id')->on('detalle_venta')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('comprobante_id')->references('id')->on('comprobante_venta')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('estado_id')->references('id')->on('estado_venta')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('metodo_pago_id')->references('id')->on('metodo_pagos')->onDelete('cascade')->onUpdate('cascade');
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*
        Schema::table('ventas', function (Blueprint $table) {
            $table->dropForeign('ventas_cliente_id_foreign');
            $table->dropForeign('ventas_comprobante_id_foreign');
            $table->dropForeign('ventas_estado_id_foreign');
            $table->dropForeign('ventas_producto_id_foreign');
            $table->dropForeign('ventas_user_id_foreign');
            $table->dropForeign('ventas_venta_id_foreign');
            $table->dropForeign('ventas_metodo_pago_id_foreign');
        });
        */
    }
}
