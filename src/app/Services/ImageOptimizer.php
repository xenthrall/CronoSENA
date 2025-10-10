<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ImageOptimizer
{
    /**
     * Optimiza una imagen almacenada en el disco 'public'.
     *
     * @param  string  $path  Ruta relativa dentro del disco (ej: 'instructores/foto.jpg')
     * @param  array   $options  Opciones de optimización
     * @return string  Nueva ruta del archivo optimizado
     */
    public function optimize(string $path, array $options = []): string
    {
        $disk = Storage::disk('public');

        if (! $disk->exists($path)) {
            throw new \Exception("La imagen no existe en la ruta: {$path}");
        }

        $imageData = $disk->get($path);

        $image = Image::read($imageData);

        // Opciones de optimización
        $maxWidth = $options['max_width'] ?? 512;
        $quality = $options['quality'] ?? 80;
        $deleteOldPath = $options['delete_old_path'] ?? false;

        if ($image->width() > $maxWidth) {
            $image = $image->scale(width: $maxWidth);
        }

        // Formato de salida
        $format = 'webp';
        $optimizedName = pathinfo($path, PATHINFO_FILENAME) . '_optimizado.' . $format;
        $optimizedPath = 'instructores/' . $optimizedName;

        // Codifica y guarda con la calidad deseada
        $encoded = $image->encodeByExtension($format, quality: $quality);
        $disk->put($optimizedPath, (string) $encoded, 'public');

        if ($deleteOldPath && $disk->exists($path)) {
            $disk->delete($path);
        }
        
        return $optimizedPath;
    }
}
