<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Str;

class ImageOptimizer
{
    /**
     * Optimiza una imagen, asegurando la ruta.
     *
     * @param  string  $path  Ruta relativa dentro del disco (ej: 'instructores/foto.jpg')
     * @param  array   $options  Opciones de optimización
     * @return string|null  Nueva ruta del archivo optimizado o null si falla
     */
    public function optimize(string $path, array $options = []): ?string
    {
        $disk = Storage::disk('public');
        $safeFilename = basename($path);
        $directory = pathinfo($path, PATHINFO_DIRNAME);

        // Reconstruye una ruta segura. Si el directorio es '.', usa un directorio por defecto.
        $safeDirectory = ($directory === '.' || empty($directory)) ? 'uploads' : $directory;
        $safePath = $safeDirectory . '/' . $safeFilename;

        if (! $disk->exists($safePath)) {
            Log::error("La imagen no existe en la ruta validada: {$safePath}");
            return null; // Devuelve null en lugar de lanzar una excepción
        }

        try {
            $imageData = $disk->get($safePath);
            $image = Image::read($imageData);

            // Opciones de optimización
            $maxWidth = $options['max_width'] ?? 512;
            $quality = $options['quality'] ?? 80;
            $deleteOriginal = $options['delete_original'] ?? false;

            if ($image->width() > $maxWidth) {
                $image = $image->scale(width: $maxWidth);
            }

            $format = 'webp';
            // Usa Str::slug para un nombre de archivo más limpio y seguro
            $filenameWithoutExt = Str::slug(pathinfo($safeFilename, PATHINFO_FILENAME));
            $optimizedName = $filenameWithoutExt . '.webp';
            // La ruta de salida respeta el directorio original
            $optimizedPath = $safeDirectory . '/' . $optimizedName;

            $encoded = $image->encodeByExtension($format, quality: $quality);
            $disk->put($optimizedPath, (string) $encoded, 'public');

            if ($deleteOriginal) {
                $disk->delete($safePath);
            }

            return $optimizedPath;
        } catch (\Exception $e) {
            // Maneja cualquier error durante el procesamiento de la imagen
            Log::error("Error al optimizar la imagen {$safePath}: " . $e->getMessage());
            return null;
        }
    }
}
