<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class GoDeskRolesSeeder extends Seeder
{
    public function run()
    {
        Role::firstOrCreate(
            ['name' => 'admin'],
            ['name' => 'admin', 'guard_name' => 'web']
        );
        Role::firstOrCreate(
            ['name' => 'developer'],
            ['name' => 'developer', 'guard_name' => 'web']
        );
    }
}