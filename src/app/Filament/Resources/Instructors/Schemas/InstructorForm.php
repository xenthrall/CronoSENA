<?php

namespace App\Filament\Resources\Instructors\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;


class InstructorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información personal')
                    ->description('Datos básicos del instructor.')
                    ->schema([
                        TextInput::make('nombre_completo')
                            ->label('Nombre completo')
                            ->required()
                            ->maxLength(50)
                            ->columnSpanFull()
                            ->placeholder('Ej. Carlos Rodríguez'),
                        /*    
                        TextInput::make('nombre')
                            ->label('Nombres')
                            ->required()
                            ->maxLength(50)
                            ->placeholder('Ej. Carlos'),
                        TextInput::make('apellido')
                            ->label('Apellidos')
                            ->required()
                            ->maxLength(50)
                            ->placeholder('Ej. Rodríguez'),
                        */

                        Select::make('tipo_documento')
                            ->label('Tipo de documento')
                            ->options([
                                'CC' => 'Cédula de ciudadanía',
                                'TI' => 'Tarjeta de identidad',
                                'CE' => 'Cédula de extranjería',
                                'PAS' => 'Pasaporte',
                            ])
                            ->native(false)
                            ->required(),
                        TextInput::make('documento')
                            ->label('Número de documento')
                            ->required()
                            ->maxLength(20),
                        TextInput::make('correo')
                            ->label('Correo electrónico')
                            ->email()
                            ->maxLength(100)
                            ->placeholder('nombre@misena.edu.co'),
                        TextInput::make('telefono')
                            ->label('Teléfono de contacto')
                            ->tel()
                            ->maxLength(15)
                            ->placeholder('Ej. 3201234567'),
                    ])->columns(2),

                Section::make('Información profesional')
                    ->description('Datos sobre la formación y asignación del instructor.')
                    ->schema([

                        Select::make('equipo_ejecutor_id')
                            ->label('Equipo ejecutor')
                            ->relationship('equipoEjecutor', 'nombre') // si existe la relación
                            //->required()
                            ->searchable()
                            ->preload()
                            ->placeholder('Seleccione un equipo'),
                        TextInput::make('especialidad')
                            ->label('Especialidad')
                            ->maxLength(100)
                            ->placeholder('Ej. Programación, Diseño web, Electricidad...'),
                        Section::make('Foto y estado')
                            ->schema([
                                FileUpload::make('foto_url')
                                    ->label('Foto de perfil')
                                    ->image()
                                    ->avatar()
                                    ->imageEditor()
                                    ->circleCropper()
                                    ->directory('instructores')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->maxSize(2048),
                                Toggle::make('activo')
                                    ->label('Instructor activo')
                                    ->default(true)
                                    ->inline(false)
                                    ->helperText('Desactiva esta opción si el instructor ya no está vinculado.'),
                            ])
                            ->columns(2),
                    ]),


            ]);
    }
}
