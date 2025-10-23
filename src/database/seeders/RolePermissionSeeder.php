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

        // Permisos
        $permisos = [
            'crear_horarios',
            'editar_horarios',
            'ver_instructores',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // Asignar permisos
        $planificador->givePermissionTo(['crear_horarios', 'editar_horarios']);
        $admin->givePermissionTo(Permission::all());
    }
}