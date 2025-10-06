<?php

namespace App\Filament\Resources\Instructors\Schemas;

use DragonCode\PrettyArray\Services\File;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class InstructorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('documento')
                    ->required(),
                TextInput::make('tipo_documento'),
                TextInput::make('nombre')
                    ->required(),
                TextInput::make('apellido')
                    ->required(),
                TextInput::make('correo')
                    ->required(),
                TextInput::make('telefono')
                    ->tel(),
                TextInput::make('equipo_ejecutor_id')
                    ->required()
                    ->numeric(),
                TextInput::make('especialidad'),
                FileUpload::make('foto_url')
                    ->label('Foto')
                    ->image()
                    ->avatar()                        // layout tipo avatar (1 archivo)
                    ->imageEditor()                   // permite recortar/editar en UI
                    ->circleCropper()                 // recorte circular (opcional)
                    ->disk('public')->directory('instructores')
                    ->visibility('public')
                    ->maxSize(2048),
                Toggle::make('activo')
                    ->required(),
            ]); 
    }
}
