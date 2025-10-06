<?php

namespace App\Filament\Resources\Programs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProgramInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('program_code'),
                TextEntry::make('name'),
                TextEntry::make('total_duration_hours')
                    ->numeric(),
                TextEntry::make('version'),
                TextEntry::make('trainingLevel.name')
                    ->label('Nivel de Formación'),
                TextEntry::make('specialProgramName.name')
                    ->label('Nombre del Programa Especial'),
                TextEntry::make('created_at')
                    ->label('Creado En')
                    ->dateTime('h:i A d/m/Y'),
                TextEntry::make('updated_at')
                    ->label('Actualizado En')
                    ->dateTime('h:i A d/m/Y'),
            ]);
    }
}
