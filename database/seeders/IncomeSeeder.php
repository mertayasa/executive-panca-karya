<?php

namespace Database\Seeders;

use App\Models\Income;
use App\Models\ReceivableLog;
use Illuminate\Database\Seeder;

class IncomeSeeder extends Seeder{

    public function run(){
        Income::factory()->count(30)->create()->each(function($income){
            if($income->status == 0){
                $log = new ReceivableLog;
                $log->id_income = $income->id;
                $log->pay = 0;
                $log->remain = $income->total;
                $log->save();
            }
        });
    }
}
