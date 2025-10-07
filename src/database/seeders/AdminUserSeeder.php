<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Instructor;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@cronosena.com'], // evita duplicados si ya existe
            [
                'name' => 'cronosena',
                'password' => Hash::make('password'), 
            ]
        );
        Instructor::firstOrCreate(
            ['email' => 'admin@cronosena.com'], // evita duplicados si ya existe
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
