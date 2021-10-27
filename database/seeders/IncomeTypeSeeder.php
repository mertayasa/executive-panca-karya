<?php

namespace Database\Seeders;

use App\Models\IncomeType;
use Illuminate\Database\Seeder;

class IncomeTypeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Penjualan Barang',
            ],
            [
                'name' => 'Jasa',
            ]
        ];

        $count = IncomeType::all()->count();
        if ($count < 3) {
            foreach ($data as $key => $d) {
                $expen_type = new IncomeType();
                $expen_type->create($d);
            }
        }
    }
}
