<?php

namespace App\Filament\Resources\Jornadas;

use App\Filament\Resources\Jornadas\Pages\ManageJornadas;
use App\Models\Jornada;
use BackedEnum;
use Dom\Text;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\CheckboxList;

class JornadaResource extends Resource
{
    protected static ?string $model = Jornada::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nombre';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required()
                    ->maxLength(100)
                    ->columnSpanFull(), // Ocupa todo el ancho

                Textarea::make('descripcion')
                    ->maxLength(255)
                    ->columnSpanFull(),

                // --- HORARIO SIMPLE (Se muestra si 'es_mixta' es falso) ---
                TimePicker::make('hora_inicio')
                    ->label('Hora de inicio')
                    ->seconds(false)
                    ->displayFormat('h:i A')
                    ->native(false)
                    ->visible(fn($get) => !$get('es_mixta')),

                TimePicker::make('hora_fin')
                    ->label('Hora de fin')
                    ->seconds(false)
                    ->displayFormat('h:i A')
                    ->native(false)
                    ->visible(fn($get) => !$get('es_mixta')),

                // --- HORARIO MIXTO (Se muestra si 'es_mixta' es verdadero) ---
                Repeater::make('segmentos')
                    ->label('Segmentos horarios')
                    ->columns(2)
                    ->schema([
                        TimePicker::make('inicio')
                            ->label('Inicio del segmento')
                            ->seconds(false)
                            ->displayFormat('h:i A')
                            ->native(false)
                            ->required(),
                        TimePicker::make('fin')
                            ->label('Fin del segmento')
                            ->seconds(false)
                            ->displayFormat('h:i A')
                            ->native(false)
                            ->required(),
                    ])
                    ->visible(fn($get) => $get('es_mixta'))
                    ->columnSpanFull(),

                CheckboxList::make('dias_validos')
                    ->label('Días hábiles / válidos')
                    ->options([
                        'Lunes' => 'Lunes',
                        'Martes' => 'Martes',
                        'Miércoles' => 'Miércoles',
                        'Jueves' => 'Jueves',
                        'Viernes' => 'Viernes',
                        'Sábado' => 'Sábado',
                        'Domingo' => 'Domingo',
                    ])
                    ->columns(4)
                    ->required()
                    ->columnSpanFull(),

                Toggle::make('es_mixta')
                    ->label('¿Es una jornada mixta (dividida)?')
                    ->live() // CLAVE: Dispara la actualización para mostrar/ocultar campos.
                    ->default(false),

                Toggle::make('activo')
                    ->label('Activo')
                    ->default(true),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nombre')
            ->columns([
                TextColumn::make('nombre')
                    ->searchable(),
                TextColumn::make('hora_inicio')
                    ->label('Hora Inicio')
                    ->time('h:i A')
                    ->placeholder('N/A (Mixta)')
                    ->sortable(),
                TextColumn::make('hora_fin')
                    ->label('Hora Fin')
                    ->time('h:i A')
                    ->placeholder('N/A (Mixta)')
                    ->sortable(),
                TextColumn::make('descripcion')
                    ->limit(50)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('dias_validos')
                    ->label('Días Válidos')
                    ->formatStateUsing(fn($state) => is_array($state) ? implode(', ', $state) : $state)
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->wrap(),
                IconColumn::make('es_mixta')
                    ->label('Mixta')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),
                IconColumn::make('activo')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageJornadas::route('/'),
        ];
    }
}
