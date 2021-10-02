<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(Range(1,10) as $val){
            DB::table('users')->insert([
                'name'=>$faker->name(),
                'branch_id'=>$faker->randomElement($array = array (5,23,22),2),
                'isadmin'=>'p',
                'email'=>$faker->unique()->safeEmail(),
            ]);
        }
    }
}
