<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTableReceivableLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('receivable_logs');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('receivable_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_income');
            $table->integer('pay');
            $table->integer('remain');
            $table->timestamps();

            $table->foreign('id_income')->references('id')->on('incomes')->onDelete('cascade')->onUpdate('cascade');
        });
    }
}
