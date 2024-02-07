<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentGatewayStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_gateway_states', function (Blueprint $table) {
            $table->id();
            $table->string('merchantId',40)->nullable();
            $table->text('estadoTx')->nullable();
            $table->text('transactionId')->nullable();
            $table->text('reference_pol')->nullable();
            $table->text('referenceCode')->nullable();
            $table->text('pseBank')->nullable();
            $table->text('cus')->nullable();
            $table->text('TX_VALUE')->nullable();
            $table->text('currency')->nullable();
            $table->text('extra1')->nullable();
            $table->text('lapPaymentMethod')->nullable();
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
        Schema::dropIfExists('payment_gateway_states');
    }
}
