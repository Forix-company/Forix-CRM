<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('nit',25)->default(0);
            $table->string('name_supplier',50)->nullable();
            $table->string('email',30)->nullable();
            $table->string('phone',15)->default(0);
            $table->string('cell_phone',15)->default(0);
            $table->string('address',30)->nullable();
            $table->text('product_offered')->nullable();
            $table->text('broucher')->nullable();
            $table->string('country',25)->nullable();
            $table->string('department',25)->nullable();
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
        Schema::dropIfExists('proveedor');
    }
}
