<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Gastos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Account_ID');
            $table->unsignedBigInteger('buys_id');
            $table->string('Concept',30);
            $table->decimal('Amount',65,2);
            $table->date('Dismissal_Date');
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
        Schema::dropIfExists('Expenses');
    }
}
