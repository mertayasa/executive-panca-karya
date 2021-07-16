<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceivableLogsTable extends Migration{

    public function up(){
        Schema::create('receivable_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_income');
            $table->integer('pay');
            $table->integer('remain');
            $table->timestamps();

            $table->foreign('id_income')->references('id')->on('incomes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down(){
        Schema::dropIfExists('receivable_logs');
    }
}
