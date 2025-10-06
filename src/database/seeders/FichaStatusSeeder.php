<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FichaStatus;

class FichaStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $estados = [
            ['name' => 'Planeada', 'code' => 'planeada', 'color' => 'gray', 'order' => 1],
            ['name' => 'En formación', 'code' => 'en_formacion', 'color' => 'info', 'order' => 2],
            ['name' => 'En productiva', 'code' => 'en_productiva', 'color' => 'primary', 'order' => 3],
            ['name' => 'Finalizada', 'code' => 'finalizada', 'color' => 'success', 'order' => 4],
            ['name' => 'Cancelada', 'code' => 'cancelada', 'color' => 'danger', 'order' => 5],
            ['name' => 'Aplazada', 'code' => 'aplazada', 'color' => 'warning', 'order' => 6],
        ];

        foreach ($estados as $estado) {
            FichaStatus::firstOrCreate(
                ['code' => $estado['code']], // clave única
                $estado // datos a crear si no existe
            );
        }
    }
}
