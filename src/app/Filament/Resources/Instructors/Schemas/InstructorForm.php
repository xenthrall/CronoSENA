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
                        TextInput::make('full_name')
                            ->label('Nombre completo')
                            ->required()
                            ->maxLength(50)
                            ->columnSpanFull()
                            ->placeholder('Ej. Carlos Rodríguez'),
                          
                        TextInput::make('name')
                            ->label('Nombre de Usuario')
                            ->required()
                            ->maxLength(50)
                            ->columnSpanFull()
                            ->placeholder('Ej. Carlos'),
                        /*  
                        TextInput::make('last_name')
                            ->label('Apellidos')
                            ->required()
                            ->maxLength(50)
                            ->placeholder('Ej. Rodríguez'),
                        */

                        Select::make('document_type')
                            ->label('Tipo de documento')
                            ->options([
                                'CC' => 'Cédula de ciudadanía',
                                'TI' => 'Tarjeta de identidad',
                                'CE' => 'Cédula de extranjería',
                                'PAS' => 'Pasaporte',
                            ])
                            ->native(false)
                            ->required(),
                        TextInput::make('document_number')
                            ->label('Número de documento')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20),
                        TextInput::make('email')
                            ->label('Correo electrónico')
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->maxLength(100)
                            ->placeholder('nombre@misena.edu.co'),
                        TextInput::make('phone')
                            ->label('Teléfono de contacto')
                            ->tel()
                            ->maxLength(15)
                            ->placeholder('Ej. 3201234567'),
                    ])->columns(2),

                Section::make('Información profesional')
                    ->description('Datos sobre la formación y asignación del instructor.')
                    ->schema([

                        Select::make('executing_team_id')
                            ->label('Equipo ejecutor')
                            ->relationship('executingTeam', 'name') // si existe la relación
                            //->required()
                            ->searchable()
                            ->preload()
                            ->placeholder('Seleccione un equipo'),
                        TextInput::make('specialty')
                            ->label('Especialidad')
                            ->maxLength(100)
                            ->placeholder('Ej. Programación, Diseño web, Electricidad...'),
                        Section::make('Foto y estado')
                            ->schema([
                                FileUpload::make('photo_url')
                                    ->label('Foto de perfil')
                                    ->image()
                                    ->avatar()
                                    ->imageEditor()
                                    ->circleCropper()
                                    ->directory('instructores')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->maxSize(2048),
                                Toggle::make('is_active')
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
