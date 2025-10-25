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

        $this->info('Iniciando sincronización de permisos...');

         $permissionsByModel = [
            'User' => [
                'user.view',
                'user.create',
                'user.edit',
                'user.delete',
            ],
            'Role' => [
                'role.view',
                'role.create',
                'role.edit',
                'role.delete',
            ],

        ];

        // Recorremos y creamos cada permiso si no existe
        foreach ($permissionsByModel as $model => $permissions) {
            foreach ($permissions as $permissionName) {
                Permission::firstOrCreate([
                    'name' => $permissionName,
                    'guard_name' => 'web',
                    'model' => $model,
                ]);
            }
        }

        $this->info('✅ Permisos sincronizados correctamente.');

        // (Opcional) Crear roles base y asignar permisos
        if ($this->confirm('¿Deseas crear roles base y asignar permisos?')) {
            $this->createBaseRoles($permissionsByModel);
        }

        return self::SUCCESS;

    }

    protected function createBaseRoles(array $permissionsByModel)
    {
        $roles = [
            'admin' => array_merge(...array_values($permissionsByModel)), // todos los permisos
            'viewer' => collect($permissionsByModel)
                ->flatten()
                ->filter(fn($perm) => str_contains($perm, 'view'))
                ->values()
                ->toArray(),
        ];

        foreach ($roles as $roleName => $perms) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
            $role->syncPermissions($perms);
        }

        $this->info('🎯 Roles base creados: admin, viewer');
    }
}
