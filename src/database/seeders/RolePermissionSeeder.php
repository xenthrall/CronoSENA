<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Roles base
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $planificador = Role::firstOrCreate(['name' => 'planificador']);

    }
}