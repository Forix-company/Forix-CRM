<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Plantilla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layout_colors', function (Blueprint $table) {
            $table->id();
            $table->string('color_logo',30)->nullable();
            $table->string('color_header',30)->nullable();
            $table->string('color_sidebar',30)->nullable();
            $table->string('color_body',30)->nullable();
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
        Schema::dropIfExists('roles');
    }
}
