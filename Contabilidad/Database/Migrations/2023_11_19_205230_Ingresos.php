<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ingresos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Income', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Account_ID');
            $table->unsignedBigInteger('sales_id');
            $table->string('Concept',30);
            $table->decimal('Amount',65,2);
            $table->date('Admission_date');
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
        Schema::dropIfExists('Income');
    }
}
