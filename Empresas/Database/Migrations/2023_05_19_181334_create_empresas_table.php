<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->integer('nit');
            $table->string('business_name',25)->nullable();
            $table->string('mail',50)->nullable();
            $table->string('phone',15)->nullable();
            $table->string('cell_phone',15)->nullable();
            $table->text('logo')->nullable();
            $table->string('address',20)->nullable();
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
        Schema::dropIfExists('empresas');
    }
}
