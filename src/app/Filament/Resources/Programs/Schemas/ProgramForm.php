<?php

namespace App\Filament\Resources\Programs\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class ProgramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('program_code')
                    ->label('Código del Programa')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('name')
                    ->label('Nombre')
                    ->required(),
                TextInput::make('total_duration_hours')
                    ->label('Duración (Horas)')
                    ->required()
                    ->numeric(),
                Select::make('training_level_id')
                    ->label('Nivel de Formación')
                    ->relationship('trainingLevel', 'name')
                    ->nullable(),
                Select::make('special_program_name_id')
                    ->label('Nombre del Programa Especial')
                    ->relationship('specialProgramName', 'name')
                    ->nullable()
                    ->searchable()
                    ->preload(),
                TextInput::make('version')
                    ->label('Versión')
                    ->maxLength(20)
                    ->default('1'),
            ]);
    }
}
