<?php

namespace App\Filament\Resources\Competencias\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CompetenciaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('codigo_norma')
                    ->required(),
                TextInput::make('nombre')
                    ->required(),
                Textarea::make('descripcion_norma')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('duracion_horas')
                    ->required()
                    ->numeric(),
                TextInput::make('version')
                    ->required()
                    ->numeric()
                    ->default(1),
                TextInput::make('estado')
                    ->required()
                    ->default('Activo'),
            ]);
    }
}
