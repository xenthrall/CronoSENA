<?php

namespace App\Support;

use Illuminate\Support\Facades\File;


/**
 * Clase auxiliar para operaciones relacionadas con almacenamiento.
 */
class StorageHelper
{

    /**
     * Elimina las imágenes de perfil de instructores del almacenamiento.
     */
    public static function cleanInstructorsProfiles(): void
    {
        $path = storage_path('app/public/instructores');

        if (File::exists($path)) {
            File::deleteDirectory($path);
        }
    }
}