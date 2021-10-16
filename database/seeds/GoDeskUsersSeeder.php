<?php

use Illuminate\Database\Seeder;
use SpaceCode\GoDesk\Models\User;

class GoDeskUsersSeeder extends Seeder
{
    public function run()
    {
        $user = User::firstOrCreate(
            ['email' => 'vladlen.beilik@gmail.com'],
            ['name' => 'Vladlen Beilik', 'lang' => 'en', 'email' => 'vladlen.beilik@gmail.com', 'password' => bcrypt('password')]
        );
        $user->assignRole('developer');
    }
}