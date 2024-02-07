<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tags_id')->references('id')->on('tags')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('state_id')->references('id')->on('state_products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('manufacturer_id')->references('id')->on('manufacturer')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('inventory_id')->references('id')->on('inventory')->onDelete('cascade')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('productos_categoria_id_foreign');
            $table->dropForeign('productos_estado_id_foreign');
            $table->dropForeign('productos_etiqueta_id_foreign');
            $table->dropForeign('productos_fabricante_id_foreign');
            $table->dropForeign('productos_user_id_foreign');
        });

    }
}
