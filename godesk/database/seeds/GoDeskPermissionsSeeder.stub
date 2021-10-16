<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class GoDeskPermissionsSeeder extends Seeder
{
    public function run()
    {
        $array = \SpaceCode\GoDesk\GoDesk::requiredPermissions();
        foreach ($array as $perm) {
            Permission::firstOrCreate(
                ['name' => $perm],
                ['name' => $perm, 'guard_name' => 'web']
            );
        }
    }
}