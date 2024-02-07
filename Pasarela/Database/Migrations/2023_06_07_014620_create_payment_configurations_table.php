<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_configurations', function (Blueprint $table) {
            $table->id();
            $table->string('NombrePasarela',15)->nullable();
            $table->string('NombreIniciales',10)->nullable();
            $table->text('url')->nullable();
            $table->text('ApiKey')->nullable();
            $table->integer('tax');
            $table->integer('taxReturnBase');
            $table->string('test',5);
            $table->string('currency',10)->nullable();
            $table->text('responseUrl')->nullable();
            $table->integer('accountId');
            $table->integer('merchantId');
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
        Schema::dropIfExists('payment_configurations');
    }
}
