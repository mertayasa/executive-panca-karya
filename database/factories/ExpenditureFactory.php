<?php

namespace Database\Factories;

use App\Models\Expenditure;
use App\Models\ExpenditureType;
use App\Models\User;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenditureFactory extends Factory{

    protected $model = Expenditure::class;

    public function definition(){
        $date = \Carbon\Carbon::now();
        return [
            'id_types' => ExpenditureType::inRandomOrder()->first()->id,
            'date' => $this->faker->dateTimeBetween(Carbon::now()->subMonth(2), $date),
            'amount' => $this->faker->numberBetween(10000, 34000),
            'note' => 'logo-panca.jpeg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'created_by' => User::where('level', 0)->first()->id,
            'updated_by' => User::where('level', 0)->first()->id,
        ];
    }

}
