<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AccountsReceivable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts_receivable', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Client_id');
            $table->unsignedBigInteger('Account_id');
            $table->text('description');
            $table->decimal('AmountReceivable',65,2);
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
        Schema::dropIfExists('accounts_receivable');
    }
}
