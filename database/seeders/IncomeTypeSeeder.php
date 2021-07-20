<?php

namespace Database\Seeders;

use App\Models\IncomeType;
use Illuminate\Database\Seeder;

class IncomeTypeSeeder extends Seeder
{
    public function run(){
        $data = [
            [
                'name' => 'Penjualan Item 1',
            ],
            [
                'name' => 'Penjualan Item 2',
            ],
            [
                'name' => 'Penjualan Item 3',
            ],
            [
                'name' => 'Penjualan Item 4',
            ],
        ];

        $count = IncomeType::all()->count();
        if($count < 3){
            foreach($data as $key => $d){
                $expen_type = new IncomeType();
                $expen_type->create($d);
            }
        }
    }
}
