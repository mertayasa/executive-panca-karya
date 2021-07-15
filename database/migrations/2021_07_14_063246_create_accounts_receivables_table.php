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
            $table->unsignedInteger('id_income');
            // $table->unsignedInteger('id_customer');
            // $table->unsignedInteger('id_income_type');
            // $table->date('date');
            // $table->string('total');
            $table->string('pay');
            $table->string('remaining_receive');
            // $table->string('ket');
            $table->timestamps();

            $table->foreign('id_income')->references('id')->on('incomes')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('id_customer')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('id_income_type')->references('id')->on('income_types')->onDelete('cascade')->onUpdate('cascade');

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
