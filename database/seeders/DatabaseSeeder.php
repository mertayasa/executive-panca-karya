<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(){
        $this->call(UserSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(IncomeTypeSeeder::class);
        $this->call(ExpenditureTypeSeeder::class);
        $this->call(IncomeSeeder::class);
        $this->call(ExpenditureSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
