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
            
            ['id' => 1, 'name' => 'Admin', 'lastname' => null, 'website' => null, 'email' => 'admin@admin.com', 'password' => '$2y$10$jB5p7HpqZ5vFbYLMP7RaSeZGJjswqlEPWb51j0YRnLA/azFtJ2BOK', 'avatar' => null, 'remember_token' => '', 'team_id' => null, 'approved' => 1,],
            ['id' => 2, 'name' => 'Instructor', 'lastname' => null, 'website' => null, 'email' => 'instructor@instructor.com', 'password' => '$2y$10$wtVeMS/o0UUsW1OqEtF16.bfySgezIXZLMhKhAdls1A1KWVRc9X3i', 'avatar' => null, 'remember_token' => null, 'team_id' => null, 'approved' => 1,],
            ['id' => 3, 'name' => 'Student', 'lastname' => null, 'website' => null, 'email' => 'student@student.com', 'password' => '$2y$10$GnZSqyRAfThj60Zg3sUW2uO7mihIXAOE2ALwahHJbE9Xf6ODtzbiG', 'avatar' => null, 'remember_token' => null, 'team_id' => null, 'approved' => 1,],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}
