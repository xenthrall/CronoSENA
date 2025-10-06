<?php

namespace App\Filament\Resources\Fichas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;


class FichaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('code')
                    ->label('Código de la ficha')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(20)
                    ->columnSpan(1),

                Select::make('municipality_id')
                    ->label('Centro de formación / Municipio')
                    ->relationship('municipality', 'name')
                    ->searchable()
                    ->preload()
                    ->columnSpan(1),

                Select::make('program_id')
                    ->label('Programa de formación')
                    ->relationship(
                        name: 'program',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn($query) => $query->select('id', 'program_code', 'name')//limita las columnas consultadas(Optimiza rendimiento).
                    )
                    ->getOptionLabelFromRecordUsing(
                        fn($record) => "{$record->program_code} - {$record->name}"
                    )
                    ->searchable(['name', 'program_code'])
                    ->searchPrompt('Buscar programa por nombre o código')
                    ->preload()
                    ->required()
                    ->columnSpan(2),

                Select::make('status_id')
                    ->label('Estado de la ficha')
                    ->relationship('status', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpan(1),

                Select::make('shift_id')
                    ->label('Jornada')
                    ->relationship('shift', 'name')
                    ->searchable()
                    ->preload()
                    ->columnSpan(1),

                Grid::make(3) // Create a grid with 3 columns
                    ->columnSpan(2) // Span the entire width of the form (2 columns)
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
