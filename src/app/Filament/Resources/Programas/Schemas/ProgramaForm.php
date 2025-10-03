<?php

namespace App\Filament\Resources\Programas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

class ProgramaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('codigo_programa')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('nombre')
                    ->required(),
                TextInput::make('duracion_total_horas')
                    ->required()
                    ->numeric(),
                Select::make('nivel_formacion_id')
                    ->relationship('nivelFormacion', 'nombre')
                    ->nullable(),
                Select::make('nombre_programa_especial_id')
                    ->label('Nombre del Programa Especial')
                    ->relationship('nombreProgramaEspecial', 'nombre')
                    ->nullable()
                    ->searchable()
                    ->preload(),
            ]);
    }
}
