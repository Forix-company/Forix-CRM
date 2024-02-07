<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BalanceSheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_sheet', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('income_id');
            $table->decimal('price_total_income',65,2);
            $table->unsignedBigInteger('expenses_id');
            $table->decimal('price_total_expenses',65,2);
            $table->date('date_balance');
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
        Schema::dropIfExists('balance_sheet');

    }
}
