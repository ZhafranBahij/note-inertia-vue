<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create note']);
        Permission::create(['name' => 'edit note']);
        Permission::create(['name' => 'delete note']);
        Permission::create(['name' => 'view note']);
    }
}
