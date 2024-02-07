<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('login_2fa_statu')->references('id')->on('settings_auths')->onDelete('cascade')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_user_id_foreign');
            $table->dropForeign('users_login_2fa_statu_foreign');
        });

    }
}
