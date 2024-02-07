<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Transacciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Bank_Transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Account_ID');
            $table->date('Transaction_Date');
            $table->string('Transaction_Type',25);
            $table->decimal('Amount',65,2);
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
        Schema::dropIfExists('Bank_Transactions');
    }
}
