<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyDevolucion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('inventory_return', function (Blueprint $table) {
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('state_id')->references('id')->on('inventory_state')->onDelete('cascade')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventory_return', function (Blueprint $table) {
            $table->dropForeign('devolucion_inventario_estado_id_foreign');
            $table->dropForeign('devolucion_inventario_proveedor_id_foreign');
        });
    }
}
