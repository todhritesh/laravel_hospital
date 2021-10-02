<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,10) as $values){
            DB::table('branches')->insert([
                'branch_name' => $faker->city(),
                'amount'=> $faker->numberBetween($min = 1000, $max = 9000)
            ]);
        }
    }
}
