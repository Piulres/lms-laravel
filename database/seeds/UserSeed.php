<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Admin', 'last_name' => null, 'email' => 'admin@admin.com', 'website' => null, 'avatar' => null, 'password' => '$2y$10$hVmtVncQrxSxXNp4y6pNH.8p39taq1aJCijCqw7/Tyc9c.XzNlQvG', 'remember_token' => '', 'team_id' => null, 'approved' => 1,],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}
