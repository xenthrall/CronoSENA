<?php

namespace App\Filament\Resources\Programs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section as InfoSection;


class ProgramInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                InfoSection::make('Detalles de la Competencia')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nombre'),

                        TextEntry::make('program_code')
                            ->label('Codigo de Programa'),

                        TextEntry::make('version')
                            ->label('Versión'),

                        TextEntry::make('total_duration_hours')
                            ->label('Duración (Horas)')
                            ->numeric(),

                        TextEntry::make('trainingLevel.name')
                            ->label('Nivel de Formación'),

                        TextEntry::make('specialProgramName.name')
                            ->label('Nombre del Programa Especial'),
                    ])
                    ->columns(2),

                InfoSection::make('Metadatos')
                    ->collapsed()
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Creado el')
                            ->dateTime('d/m/Y H:i'),

                        TextEntry::make('updated_at')
                            ->label('Actualizado el')
                            ->dateTime('d/m/Y H:i'),
                        InfoSection::make('Descripción')
                            ->schema([
                                TextEntry::make('description')
                                    ->label('Descripción')
                                    ->placeholder('Sin descripción')
                                    ->wrap(),
                            ])->columnSpanFull(),
                    ])->columns(3),
            ]);
    }
}
