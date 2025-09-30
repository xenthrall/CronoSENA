<?php

namespace App\Filament\Resources\Competencias\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;


class CompetenciaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('tipo_competencia_id')
                    ->label('Tipo de Competencia')
                    ->relationship('tipoCompetencia', 'nombre')
                    ->nullable()
                    ->searchable()
                    ->preload(),

                TextInput::make('codigo_norma')
                    ->label('Código Norma')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(50),

                TextInput::make('nombre')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),

                Textarea::make('descripcion_norma')
                    ->label('Descripción')
                    ->rows(4)
                    ->columnSpanFull(),

                TextInput::make('duracion_horas')
                    ->label('Duración (Horas)')
                    ->numeric()
                    ->required(),

                TextInput::make('version')
                    ->label('Versión')
                    ->maxLength(20)
                    ->default('1'),
            ]);
    }
}
