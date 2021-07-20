<?php

namespace Database\Seeders;

use App\Models\Staff;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(){
        $staff_count = User::where('level', 0)->count();
        $owner_count = User::where('level', 1)->count();

        $faker = Faker::create('id_ID');
        
        $staff = [
            'name' => 'Staff',
            'email' => $faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('asdasdasd'), // password
            'remember_token' => Str::random(10),
        ];

        $owner = [
            'name' => 'Admin',
            'email' => $faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('asdasdasd'), // password
            'remember_token' => Str::random(10),
            'level' => 1
        ];

        $create_staff = User::create($staff);
        $create_owner = User::create($owner);
        $new_staff = new Staff;
        $new_staff->id_user = $create_staff->id;
        $new_staff->date = Carbon::now();
        $new_staff->gender = (bool)random_int(0, 1);
        $new_staff->telp = '98123912790';
        $new_staff->address = $faker->address();
        $new_staff->save();


    }
}
