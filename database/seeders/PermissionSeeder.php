<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view',
            'create',
            'edit',
            'delete',
            'view-users',
            'assign-role',
        ];

        foreach($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
