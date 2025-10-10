<?php

namespace App\Filament\Resources\Instructors\Pages;

use App\Filament\Resources\Instructors\InstructorResource;
use App\Services\ImageOptimizer; // <-- 1. Importa el servicio
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log; // <-- 2. Importa el Log

class CreateInstructor extends CreateRecord
{
    protected static string $resource = InstructorResource::class;

     /**
     * Se ejecuta antes de que los datos del formulario se usen para crear el registro.
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        dd($data);
        // Si no se subió una foto, no hacemos nada.
        if (empty($data['photo_url'])) {
            return $data;
        }

        try {
            $optimizer = app(ImageOptimizer::class);
            $optimizedPath = $optimizer->optimize($data['photo_url'], [
                'max_width' => 150,
                'quality' => 80,
                'delete_original' => true, // Borra la imagen original sin optimizar
            ]);

            // Si la optimización fue exitosa, actualizamos el path en los datos a guardar
            if ($optimizedPath) {
                $data['photo_url'] = $optimizedPath;
            }
            
        } catch (\Exception $e) {
            Log::error("Fallo al optimizar imagen para nuevo instructor: " . $e->getMessage());
            // Opcional: podrías mostrar una notificación de error al usuario aquí.
        }

        return $data;
    }
    
}
