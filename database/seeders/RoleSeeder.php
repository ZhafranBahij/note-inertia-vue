<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = Permission::all();

        $superadmin = Role::create(['name' => 'superadmin']);
        $superadmin->syncPermissions($permissions);

        $user = Role::create(['name' => 'user']);
        $user->syncPermissions([
            'create note',
            'edit note',
            'view note',
        ]);
    }
}
