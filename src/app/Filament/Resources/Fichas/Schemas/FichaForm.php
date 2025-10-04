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
                TextInput::make('codigo')
                    ->label('Código de la ficha')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(20)
                    ->columnSpan(1),

                Select::make('municipio_id')
                    ->label('Centro de formación / Municipio')
                    ->relationship('municipio', 'nombre')
                    ->searchable()
                    ->preload()
                    ->columnSpan(1),

                Select::make('programa_id')
                    ->label('Programa de formación')
                    ->relationship(
                        name: 'programa',
                        titleAttribute: 'nombre',
                        modifyQueryUsing: fn($query) => $query->select('id', 'codigo_programa', 'nombre')//limita las columnas consultadas(Optimiza rendimiento).
                    )
                    ->getOptionLabelFromRecordUsing(
                        fn($record) => "{$record->codigo_programa} - {$record->nombre}"
                    )
                    ->searchable(['nombre', 'codigo_programa'])
                    ->searchPrompt('Buscar programa por nombre o código')
                    ->preload()
                    ->required()
                    ->columnSpan(2),

                Select::make('estado_id')
                    ->label('Estado de la ficha')
                    ->relationship('estado', 'nombre')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpan(1),

                Select::make('jornada_id')
                    ->label('Jornada')
                    ->relationship('jornada', 'nombre')
                    ->searchable()
                    ->preload()
                    ->columnSpan(1),

                Grid::make(3) // Create a grid with 3 columns
                    ->columnSpan(2) // Span the entire width of the form (2 columns)
                    ->schema([
                        DatePicker::make('fecha_inicio')
                            ->label('Fecha de inicio')
                            ->required(),

                        DatePicker::make('fecha_fin_lectiva')
                            ->label('Fin lectiva')
                            ->helperText('Fecha estimada de fin de etapa lectiva'),

                        DatePicker::make('fecha_fin')
                            ->label('Fin total')
                            ->helperText('Fecha final de etapa productiva o cierre oficial'),
                    ]),
            ]);
    }
}
