<?php

namespace Database\Seeders;

use App\Models\Income;
use App\Models\ReceivableLog;
use Illuminate\Database\Seeder;

class IncomeSeeder extends Seeder
{

    public function run()
    {
        Income::factory()->count(30)->create()->each(function ($income) {
            // if($income->status == 0){
            //     $log = new ReceivableLog;
            //     $log->id_income = $income->id;
            //     $log->pay = 0;
            //     $log->remain = $income->total;
            //     $log->save();
            // }
        });

        $init_invoice = '00001';
        $incomes = Income::all();

        foreach ($incomes as $key => $income) {
            if ($key == 0) {
                $income->invoice_no = $init_invoice;
                $income->save();
            } else {
                $last_invoice = ltrim($init_invoice, '0');
                $invoice_no = sprintf("%05d", $last_invoice + 1);
                $income->invoice_no = $invoice_no;
                $income->save();
                $init_invoice = $invoice_no;
            }
        }
    }
}
