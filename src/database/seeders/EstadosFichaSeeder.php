<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EstadoFicha;

class EstadosFichaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $estados = [
            ['nombre' => 'Planeada', 'codigo' => 'planeada', 'color' => 'gray', 'orden' => 1],
            ['nombre' => 'En formación', 'codigo' => 'en_formacion', 'color' => 'info', 'orden' => 2],
            ['nombre' => 'En productiva', 'codigo' => 'en_productiva', 'color' => 'primary', 'orden' => 3],
            ['nombre' => 'Finalizada', 'codigo' => 'finalizada', 'color' => 'success', 'orden' => 4],
            ['nombre' => 'Cancelada', 'codigo' => 'cancelada', 'color' => 'danger', 'orden' => 5],
            ['nombre' => 'Aplazada', 'codigo' => 'aplazada', 'color' => 'warning', 'orden' => 6],
        ];

        foreach ($estados as $estado) {
            EstadoFicha::firstOrCreate(
                ['codigo' => $estado['codigo']], // clave única
                $estado // datos a crear si no existe
            );
        }
    }
}
