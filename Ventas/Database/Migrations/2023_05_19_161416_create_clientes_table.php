<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->integer('nit');
            $table->string('name_customer',40)->nullable();
            $table->string('email',50)->nullable();
            $table->string('cell_phone',15)->nullable();
            $table->string('phone',15)->nullable();
            $table->string('adress',25)->nullable();
            $table->string('country',25)->nullable();
            $table->string('departament',25)->nullable();
            $table->string('city',25)->nullable();
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
        Schema::dropIfExists('cliente');
    }
}
