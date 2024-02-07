<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyContabilidad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Income', function (Blueprint $table) {
            $table->foreign('Account_ID')->references('id')->on('Bank_Accounts')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('Expenses', function (Blueprint $table) {
            $table->foreign('Account_ID')->references('id')->on('Bank_Accounts')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('accounts_payable', function (Blueprint $table) {
            $table->foreign('Account_id')->references('id')->on('Bank_Accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');

        });

        Schema::table('accounts_receivable', function (Blueprint $table) {
            $table->foreign('Account_id')->references('id')->on('Bank_Accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('Client_id')->references('id')->on('customer')->onDelete('cascade')->onUpdate('cascade');

        });

        Schema::table('bank_transactions', function (Blueprint $table) {
            $table->foreign('Account_ID')->references('id')->on('Bank_Accounts')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('balance_sheet', function (Blueprint $table) {
            $table->foreign('income_id')->references('id')->on('income')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('expenses_id')->references('id')->on('expenses')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Income', function (Blueprint $table) {
            $table->dropForeign('income_account_id_foreign');
        });

        Schema::table('Expenses', function (Blueprint $table) {
            $table->dropForeign('expenses_account_id_foreign');
        });

        Schema::table('accounts_payable', function (Blueprint $table) {
            $table->dropForeign('accounts_payable_account_id_foreign');
            $table->dropForeign('accounts_payable_supplier_id_foreign');
        });

        Schema::table('accounts_receivable', function (Blueprint $table) {
            $table->dropForeign('accounts_receivable_account_id_foreign');
            $table->dropForeign('accounts_receivable_client_id_foreign');
        });

        Schema::table('bank_transactions', function (Blueprint $table) {
            $table->dropForeign('bank_transactions_account_id_foreign');
        });

    }
}
