<?php

namespace App\Filament\Resources\Instructors\Pages;

use App\Filament\Resources\Instructors\InstructorResource;
use App\Services\ImageOptimizer; 
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log; 

class CreateInstructor extends CreateRecord
{
    protected static string $resource = InstructorResource::class;

     /**
     * Se ejecuta antes de que los datos del formulario se usen para crear el registro.
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
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

            if ($optimizedPath) {
                $data['photo_url'] = $optimizedPath;
            }
            
        } catch (\Exception $e) {
            Log::error("Fallo al optimizar imagen para nuevo instructor: " . $e->getMessage());
            // Opcional: mostrar una notificación de error al usuario aquí.
        }

        return $data;
    }
    
}
