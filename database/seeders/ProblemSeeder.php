<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Faker\Factory as Faker;

class ProblemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,10) as $cal){
            DB::table('problems')->insert([
                'problem' => $faker->word(),
                'problem_descr'=>$faker->text($maxNbChars = 200) ,
                'user_id'=>$faker->randomElement($array = array(20,21,23,24,31,33,29,12,11,10)),
            ]);
        }
    }
}
