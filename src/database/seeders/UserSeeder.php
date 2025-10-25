<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Instructor;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 🔹 Aseguramos que existan los roles base antes de asignarlos
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $planificadorRole = Role::firstOrCreate(['name' => 'viewer']);

        // 🔹 Usuario administrador
        $admin = User::firstOrCreate(
            ['email' => 'admin@cronosena.com'],
            [
                'name' => 'cronosena',
                'password' => Hash::make('password'),
            ]
        );

        // Asignar rol admin si no lo tiene aún
        if (! $admin->hasRole('admin')) {
            $admin->assignRole($adminRole);
        }

        // 🔹 Usuario planificación académica
        $planificador = User::firstOrCreate(
            ['email' => 'planificacion@cronosena.com'],
            [
                'name' => 'planificacion',
                'password' => Hash::make('password'),
            ]
        );

        if (! $planificador->hasRole('viewer')) {
            $planificador->assignRole($planificadorRole);
        }

        // 🔹 Usuario instructor (usa su propio modelo)
        Instructor::firstOrCreate(
            ['email' => 'instructor@cronosena.com'],
            [
                'document_number' => '000000001',
                'document_type' => 'CC',
                'full_name' => 'Instructor Cronosena',
                'name' => 'Instructor',
                'last_name' => 'Cronosena',
                'phone' => '3000000001',
                'password' => Hash::make('password'),
                'is_active' => true,
            ]
        );
    }
}
