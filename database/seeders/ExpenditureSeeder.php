<?php

namespace Database\Seeders;

use App\Models\Expenditure;
use Illuminate\Database\Seeder;

class ExpenditureSeeder extends Seeder{

    public function run(){
        Expenditure::factory()->count(30)->create();
    }
}
