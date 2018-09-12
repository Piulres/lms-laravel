<?php

use Illuminate\Database\Seeder;

class RoleUserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i=0;$i<10;$i++){
        DB::table('role_user')->insert([
            'role_id' => $faker->numberBetween(2,3),
            'user_id' => $faker->randomDigitNotNull,
        ]);
        }
    }
}
