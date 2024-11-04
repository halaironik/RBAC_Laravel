<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);

        $adminRole->permissions()->detach();
        $adminRole->permissions()->sync(Permission::all());

    }
}
