<?php

namespace Database\Seeders;

use App\Models\Expenditure;
use App\Models\ExpenditureType;
use Illuminate\Database\Seeder;

class ExpenditureTypeSeeder extends Seeder
{
    public function run(){
        $data = [
            [
                'name' => 'Kebersihan',
            ],
            [
                'name' => 'Listrik',
            ],
            [
                'name' => 'Internet',
            ],
            [
                'name' => 'Lain-Lain',
            ],
        ];

        $count = ExpenditureType::all()->count();
        if($count < 2){
            foreach($data as $d){
                $expen_type = new ExpenditureType;
                $expen_type->create($d);
            }
        }
    }
}
