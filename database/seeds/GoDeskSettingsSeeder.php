<?php

use Illuminate\Database\Seeder;
use SpaceCode\GoDesk\Models\Settings;

class GoDeskSettingsSeeder extends Seeder
{
    public function run()
    {
        Settings::firstOrCreate(
            ['key' => 'website_langs'],
            ['key' => 'website_langs', 'value' => '["en"]']
        );
        Settings::firstOrCreate(
            ['key' => 'website_lang'],
            ['key' => 'website_lang', 'value' => 'en']
        );
        Settings::firstOrCreate(
            ['key' => 'prefix_profile'],
            ['key' => 'prefix_profile', 'value' => 'profile']
        );
        Settings::firstOrCreate(
            ['key' => 'prefix_post'],
            ['key' => 'prefix_post', 'value' => 'post']
        );
        Settings::firstOrCreate(
            ['key' => 'prefix_post_tag'],
            ['key' => 'prefix_post_tag', 'value' => 'post-tag']
        );
        Settings::firstOrCreate(
            ['key' => 'prefix_post_category'],
            ['key' => 'prefix_post_category', 'value' => 'post-category']
        );
        Settings::firstOrCreate(
            ['key' => 'hide_from_index'],
            ['key' => 'hide_from_index', 'value' => '1']
        );
    }
}