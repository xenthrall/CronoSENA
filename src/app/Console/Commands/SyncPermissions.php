<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class SyncPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cronosena:sync-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincroniza los permisos definidos en el sistema con la base de datos.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Iniciando sincronización de permisos...');

        $permissions = [
            'Usuarios' => [
                ['name' => 'user.view', 'action' => 'Ver Usuarios', 'description' => 'Permite ver la lista de usuarios.'],
                ['name' => 'user.create', 'action' => 'Crear Usuario', 'description' => 'Permite registrar nuevos usuarios en el sistema.'],
                ['name' => 'user.edit', 'action' => 'Editar Usuario', 'description' => 'Permite modificar la información de los usuarios existentes.'],
                ['name' => 'user.delete', 'action' => 'Eliminar Usuario', 'description' => 'Permite eliminar usuarios del sistema.'],
                ['name' => 'user.manageRoles', 'action' => 'Asignar Roles', 'description' => 'Permite asignar o modificar roles y permisos de los usuarios.'],
            ],
            
            'Roles y Permisos' => [
                ['name' => 'role.view', 'action' => 'Ver Roles', 'description' => 'Permite ver la lista de roles.'],
                ['name' => 'role.edit', 'action' => 'Editar Rol', 'description' => 'Permite modificar permisos de roles.'],
                ['name' => 'role.create', 'action' => 'Crear Rol', 'description' => 'Permite crear nuevos roles.'],
                ['name' => 'role.delete', 'action' => 'Eliminar Rol', 'description' => 'Permite eliminar roles existentes.'],
            ],

            'Paneles' => [
                ['name' => 'panel.admin.access', 'action' => 'Acceso al Panel Administrativo', 'description' => 'Permite acceder y visualizar el panel administrativo del sistema.'],
                ['name' => 'panel.planificacion.access', 'action' => 'Acceso al Panel de Planificación', 'description' => 'Permite acceder y visualizar el panel de planificación del sistema.'],
            ],
            
            'Reportes' => [
                ['name' => 'reportes.export', 'action' => 'Exportar Reportes', 'description' => 'Permite descargar reportes en PDF o Excel.'],
            ],
        ];

        foreach ($permissions as $group => $perms) {
            foreach ($perms as $perm) {
                Permission::firstOrCreate(
                    ['name' => $perm['name'], 'guard_name' => 'web'],
                    [
                        'group' => $group,
                        'action' => $perm['action'],
                        'description' => $perm['description'],
                    ]
                );
            }
        }

        $this->info('✅ Permisos sincronizados correctamente.');

        if ($this->confirm('¿Deseas crear roles base y asignar permisos?')) {
            $this->createBaseRoles($permissions);
        }

        return self::SUCCESS;
    }

    protected function createBaseRoles(array $permissions)
    {
        $roles = [
            'admin' => array_merge(...array_values($permissions)), // todos los permisos
            'viewer' => collect($permissions)
                ->flatten(1)
                ->filter(fn($perm) => str_contains($perm['name'], 'view'))
                ->values()
                ->toArray(),
        ];

        foreach ($roles as $roleName => $perms) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
            $role->syncPermissions(collect($perms)->pluck('name')->toArray());
        }

        $this->info('🎯 Roles base creados y sincronizados: admin, viewer');
    }
}
