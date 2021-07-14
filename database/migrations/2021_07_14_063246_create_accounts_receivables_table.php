<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsReceivablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts_receivables', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_cust');
            $table->unsignedInteger('id_incomeType');
            $table->date('date');
            $table->string('total');
            $table->string('pay');
            $table->string('remaining_receive');
            $table->timestamps();

            $table->foreign('id_cust')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_incomeType')->references('id')->on('income_types')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts_receivables');
    }
}
