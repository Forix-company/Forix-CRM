<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('id_sales_check',30)->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sale_state_id');
            $table->unsignedBigInteger('products_id');
            $table->unsignedBigInteger('receipt_sales_id');
            $table->unsignedBigInteger('sale_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->text('observations')->nullable();
            $table->decimal('total',65,2)->default(0);
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
        Schema::dropIfExists('ventas');
    }
}
