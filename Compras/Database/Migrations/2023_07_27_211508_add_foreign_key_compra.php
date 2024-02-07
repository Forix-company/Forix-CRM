<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyCompra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('buys', function (Blueprint $table) {
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('voucher_id')->references('id')->on('sales_receipt')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('state_id')->references('id')->on('sales_state')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('authorized_id')->references('id')->on('purchase_authorizations')->onDelete('cascade')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('buys', function (Blueprint $table) {
            $table->dropForeign('compra_autorizado_id_foreign');
            $table->dropForeign('compra_comprobante_id_foreign');
            $table->dropForeign('compra_estado_id_foreign');
            $table->dropForeign('compra_proveedor_id_foreign');
            $table->dropForeign('compra_user_id_foreign');
        });

    }
}
