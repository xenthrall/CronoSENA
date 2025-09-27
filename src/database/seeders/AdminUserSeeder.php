<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
    }
}
