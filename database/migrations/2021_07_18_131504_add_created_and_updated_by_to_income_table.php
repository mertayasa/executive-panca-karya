<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreatedAndUpdatedByToIncomeTable extends Migration{

    public function up(){
        Schema::table('incomes', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down(){
        Schema::table('incomes', function (Blueprint $table) {
            $table->dropForeign(['created_by', 'updated_by']);
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });
    }
}
