<?php

use Illuminate\Database\Seeder;

class TrailTrailCategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i=0;$i<20;$i++){
            DB::table('trail_trailcategory')->insert([
                'trail_id' => $faker->randomDigitNotNull,
                'trailcategory_id' => $faker->randomDigitNotNull,
            ]);
        }
    }
}
