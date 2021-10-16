<?php

use Illuminate\Database\Seeder;
use SpaceCode\GoDesk\Models\Page;

class GoDeskPagesSeeder extends Seeder
{
    public function run()
    {
        Page::firstOrCreate(
            ['slug' => 'homepage'],
            ['author_id' => 1, 'type' => 'home', 'locale' => 'en', 'title' => 'Homepage', 'slug' => 'homepage', 'status' => 'published', 'guard_name' => 'web']
        );
    }
}