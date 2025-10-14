<?php

namespace App\Filament\Instructor\Pages\Auth;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use App\Services\ImageOptimizer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EditProfile extends BaseEditProfile
{

    public ?string $originalPhotoPath = null;

    protected function getRedirectUrl(): string
    {
        return static::getUrl();
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Información personal')
                ->description('Actualiza tus datos básicos y tu foto de perfil.')
                ->schema([
                    FileUpload::make('photo_url')
                        ->label('Foto de perfil')
                        ->hiddenLabel()
                        ->image()
                        ->avatar()
                        ->imageEditor()
                        ->circleCropper()
                        ->directory('instructores')
                        ->disk('public')
                        ->visibility('public')
                        ->maxSize(2048)
                        ->columnSpanFull()
                        ->hint('Esta imagen aparecerá en tu tarjeta de instructor y en las fichas asignadas.')
                        ->extraAttributes(['class' => '']),

                    TextInput::make('name')
                        ->label('Nombre')
                        ->required()
                        ->maxLength(50)
                        ->placeholder('Ej. Carlos'),

                    TextInput::make('last_name')
                        ->label('Apellido')
                        ->maxLength(50)
                        ->placeholder('Ej. Rodríguez'),

                    TextEntry::make('document_number')
                        ->label('Número de documento')
                        ->color('primary'),

                    TextInput::make('phone')
                        ->label('Teléfono de contacto')
                        ->tel()
                        ->maxLength(15)
                        ->placeholder('Ej. 3201234567'),
                ])
                ->columns(2),


            Section::make('Información profesional')
                ->schema([
                    TextEntry::make('executingTeam.name')
                        ->label('Equipo ejecutor')
                        ->color('primary'),

                    TextInput::make('specialty')
                        ->label('Especialidad')
                        ->maxLength(100)
                        ->placeholder('Ej. Programación, Diseño web, Electricidad...'),
                ])
                ->columns(2),


            Section::make('Datos de acceso')
                ->description('Actualiza tus credenciales de ingreso al sistema.')
                ->schema([
                    $this->getEmailFormComponent(),
                    $this->getPasswordFormComponent(),
                    $this->getPasswordConfirmationFormComponent(),
                    $this->getCurrentPasswordFormComponent(),
                ])
                ->columns(2),
        ]);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->originalPhotoPath = $this->getUser()->photo_url;
        $newPath = $data['photo_url'];

        if ($this->originalPhotoPath === $newPath || !$newPath) {
            return $data;
        }

        try {
            $optimizer = app(ImageOptimizer::class);
            $optimizedPath = $optimizer->optimize($newPath, [
                'max_width' => 200,
                'quality' => 70,
                'delete_original' => true,
            ]);

            if ($optimizedPath) {
                $data['photo_url'] = $optimizedPath;
            }
        } catch (\Exception $e) {
            Log::error("Fallo al optimizar la nueva imagen para el instructor ID {$this->getRecord()->id}: " . $e->getMessage());
        }

        return $data;
    }

    /**
     * 6. El hook `afterSave` funciona exactamente igual.
     */

    protected function afterSave(): void
    {
        $currentPhotoPath = $this->getUser()->photo_url;

        if ($this->originalPhotoPath && $this->originalPhotoPath !== $currentPhotoPath) {
            Storage::disk('public')->delete($this->originalPhotoPath);
        }
    }
}
