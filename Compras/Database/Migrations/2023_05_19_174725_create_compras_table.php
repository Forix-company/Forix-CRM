<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buys', function (Blueprint $table) {
            $table->id();
            $table->integer('code');
            $table->string('name_complete',40)->nullable();
            $table->text('observations')->nullable();
            $table->integer('quantity');
            $table->decimal('price',65,2)->default(0);
            $table->integer('discount');
            $table->decimal('total',65,2)->default(0);
            $table->text('broucher')->nullable();
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('voucher_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('authorized_id');
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
        Schema::dropIfExists('buys');
    }
}
