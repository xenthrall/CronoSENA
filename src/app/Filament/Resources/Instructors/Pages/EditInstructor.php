<?php

namespace App\Filament\Resources\Instructors\Pages;

use App\Filament\Resources\Instructors\InstructorResource;
use App\Services\ImageOptimizer;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EditInstructor extends EditRecord
{
    protected static string $resource = InstructorResource::class;

    /**
     * Propiedad para almacenar temporalmente la ruta de la foto original.
     */
    public ?string $originalPhotoPath = null;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->visible(fn () => Auth::user()?->can('instructor.delete')),
        ];
    }
    protected function getRedirectUrl(): string
    {
        // Redirige de vuelta a la página de edición del registro actual.
        return static::getResource()::getUrl('edit', ['record' => $this->getRecord()]);
    }


    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->originalPhotoPath = $this->getRecord()->photo_url;
        $newPath = $data['photo_url'];

        // Si la foto no cambió o no hay nueva foto, no hacemos nada más aquí.
        if ($this->originalPhotoPath === $newPath || !$newPath) {
            return $data;
        }

        // Si se subió una nueva foto, la optimizamos.
        try {
            $optimizer = app(ImageOptimizer::class);
            $optimizedPath = $optimizer->optimize($newPath, [
                'max_width' => 150,
                'quality' => 80,
                'delete_original' => true,
            ]);

            if ($optimizedPath) {
                $data['photo_url'] = $optimizedPath;
            }
        } catch (\Exception $e) {
            Log::error("Fallo al optimizar la nueva imagen para el instructor ID {$this->getRecord()->id}: " . $e->getMessage());
            // Opcional: Podrías revertir al path original para no guardar una ruta rota.
            // $data['photo_url'] = $this->originalPhotoPath;
        }

        return $data;
    }

    /**
     * Se ejecuta DESPUÉS de que el registro se ha guardado correctamente.
     * Este es el lugar seguro para eliminar archivos antiguos.
     */
    protected function afterSave(): void
    {
        $currentPhotoPath = $this->getRecord()->photo_url;

        // Si la ruta original existe y es diferente a la nueva, la eliminamos.
        // Esto cubre tanto el reemplazo de una foto como su eliminación (cuando $currentPhotoPath es null).
        if ($this->originalPhotoPath && $this->originalPhotoPath !== $currentPhotoPath) {
            Storage::disk('public')->delete($this->originalPhotoPath);
        }
    }
}
