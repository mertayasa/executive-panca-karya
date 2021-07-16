<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomesTable extends Migration{

    public function up(){
        Schema::create('incomes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_income_type');
            $table->unsignedInteger('id_customer');
            $table->tinyInteger('status')->default(0);
            $table->date('date');
            $table->string('total');
            $table->integer('receivable_remain');
            $table->text('ket');
            $table->timestamps();

             $table->foreign('id_income_type')->references('id')->on('income_types')->onDelete('cascade')->onUpdate('cascade');
             $table->foreign('id_customer')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    public function down(){
        Schema::dropIfExists('incomes');
    }
}
