<?php

namespace App\Filament\Instructor\Resources\Fichas\Schemas;

use Dom\Text;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;

class FichaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextEntry::make('code')
                    ->label('Código de la ficha')
                    ->disabled()
                    ->columnSpan(1),

                TextEntry::make('municipality.name')
                    ->label('Centro de formación / Municipio')
                    ->columnSpan(1),
                TextEntry::make('program.name')
                    ->label('Programa de formación')
                    ->columnSpan(2),

                TextEntry::make('status.name')
                    ->label('Estado de la ficha')
                   
                    ->columnSpan(1),

                Select::make('shift_id')
                    ->label('Jornada')
                    ->relationship('shift', 'name')
                    ->searchable()
                    ->preload()
                    ->columnSpan(1),

                Grid::make(3)
                    ->columnSpan(2) 
                    ->schema([
                        DatePicker::make('start_date')
                            ->label('Fecha de inicio')
                            ->required(),

                        DatePicker::make('lective_end_date')
                            ->label('Fin lectiva')
                            ->helperText('Fecha estimada de fin de etapa lectiva'),

                        DatePicker::make('end_date')
                            ->label('Fin total')
                            ->helperText('Fecha final de etapa productiva o cierre oficial'),
                    ]),
            ]);
    }
}
