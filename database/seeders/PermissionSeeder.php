<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create.role',
            'edit.role',
            'delete.role',
            'index.role',
            'create.user',
            'edit.user',
            'delete.user',
            'index.user',
            'create.product',
            'index.product',
            'edit.product',
            'delete.product',
            'create.permission',
            'index.permission',
            'edit.permission',
            'delete.permission'
        ];

        // Looping and Inserting Array's Permissions into Permission Table
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
