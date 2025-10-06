<?php

namespace App\Filament\Resources\Competencies\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

class CompetencyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('competency_type_id')
                    ->label('Tipo de Competencia')
                    ->relationship('competencyType', 'name')
                    ->nullable()
                    ->searchable()
                    ->preload(),

                TextInput::make('code')
                    ->label('Código Norma')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(50),

                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->label('Descripción')
                    ->rows(4)
                    ->columnSpanFull(),

                TextInput::make('duration_hours')
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
