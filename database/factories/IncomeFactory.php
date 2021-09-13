<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Income;
use App\Models\IncomeType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeFactory extends Factory
{
    protected $model = Income::class;

    public function definition(){
        $date = \Carbon\Carbon::now();
        $total = $this->faker->numberBetween(10000, 34000);
        $status = (bool)random_int(0, 1);
        return [
            'id_income_type' => IncomeType::inRandomOrder()->first()->id,
            'date' => $this->faker->dateTimeBetween(Carbon::now()->subMonth(2), $date),
            'total' => $total,
            'id_customer' => Customer::inRandomOrder()->first()->id,
            'status' => $status,
            'receivable_remain' => $status == 0 ? $total : 0,
            'ket' => $this->faker->sentence(),
            'receiver_name' => $this->faker->name(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'created_by' => User::where('level', 0)->first()->id,
            'updated_by' => User::where('level', 0)->first()->id,
        ];
    }
}
