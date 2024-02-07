<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('sku');
            $table->text('imagen')->nullable();
            $table->string('name_products',40)->nullable();
            $table->text('description_products')->nullable();
            $table->integer('quantities');
            $table->decimal('price',65,2)->nullable();
            $table->integer('inventory_min');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('tags_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('manufacturer_id');
            $table->unsignedBigInteger('inventory_id');
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
        Schema::dropIfExists('productos');
    }
}
