<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyInventario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('inventory', function (Blueprint $table) {
            $table->foreign('entrance_id')->references('id')->on('inventory_entry')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('return_id')->references('id')->on('inventory_return')->onDelete('SET NULL')->onUpdate('cascade');
        });

        Schema::table('inventory_entry', function (Blueprint $table) {
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('buys_id')->references('id')->on('buys')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('inventory', function (Blueprint $table) {
            $table->dropForeign('inventario_devoluciones_id_foreign');
            $table->dropForeign('inventario_ingreso_id_foreign');
        });

        Schema::table('inventory_entry', function (Blueprint $table) {
            $table->dropForeign('ingreso_inventario_compra_id_foreign');
            $table->dropForeign('ingreso_inventario_estado_id_foreign');
            $table->dropForeign('ingreso_inventario_proveedor_id_foreign');
        });
    }
}
