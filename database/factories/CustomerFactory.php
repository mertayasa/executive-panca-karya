<?php

namespace Database\Factories;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(){
        $date = \Carbon\Carbon::now();
        $status = (bool)random_int(0, 1);

        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'no_telp' => '273128312738',
            'place_of_birth' => $this->faker->address(),
            'date' => $this->faker->dateTimeBetween(Carbon::now()->subMonth(2), $date),
            'gender' => $status,
            'status' => $status,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
