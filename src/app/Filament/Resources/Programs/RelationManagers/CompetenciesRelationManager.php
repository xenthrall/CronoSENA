<?php

namespace App\Filament\Resources\Programs\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section as InfoSection;
use Filament\Tables\Filters\SelectFilter;

class CompetenciesRelationManager extends RelationManager
{
    protected static string $relationship = 'competencies';

    protected static ?string $title = 'Competencias';

    protected static ?string $modelLabel = 'Competencia';


    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make()->schema([
                    Select::make('competency_type_id')
                        ->label('Tipo de Competencia')
                        ->relationship('competencyType', 'name')
                        ->nullable()
                        ->preload(),

                    TextInput::make('name')
                        ->label('Nombre')
                        ->required()
                        ->maxLength(255)
                        ->columnSpan(2)
                        ->placeholder('Ejemplo: Desarrollo de Aplicaciones Web'),
                ])->columns(3)->columnSpanFull(),
                Grid::make()->schema([
                    TextInput::make('code')
                        ->label('Código Norma')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(10),

                    TextInput::make('duration_hours')
                        ->label('Duración (Horas)')
                        ->minValue(0)
                        ->numeric()
                        ->required(),

                    TextInput::make('version')
                        ->label('Versión')
                        ->maxLength(20)
                        ->default('1'),
                ])->columns(3)->columnSpanFull(),

                Textarea::make('description')
                    ->label('Descripción')
                    ->rows(4)
                    ->placeholder('Descripción de la norma...')
                    ->columnSpanFull(),


            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                InfoSection::make('Detalles de la Competencia')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nombre'),

                        TextEntry::make('code')
                            ->label('Código Norma'),

                        TextEntry::make('competencyType.name')
                            ->label('Tipo de Competencia'),

                        TextEntry::make('version')
                            ->label('Versión'),

                        TextEntry::make('duration_hours')
                            ->label('Duración (Horas)')
                            ->numeric(),
                    ])
                    ->columns(2),

                InfoSection::make('Descripción')
                    ->schema([
                        TextEntry::make('description')
                            ->label('Descripción')
                            ->placeholder('Sin descripción')
                            ->wrap(),
                    ]),

                InfoSection::make('Metadatos')
                    ->collapsed()
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Creado el')
                            ->dateTime('d/m/Y H:i'),

                        TextEntry::make('updated_at')
                            ->label('Actualizado el')
                            ->dateTime('d/m/Y H:i'),
                    ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('code')
                    ->label('Código Norma')
                    ->searchable(),

                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->limit(50),

                TextColumn::make('competencyType.name')
                    ->label('Tipo de Competencia')
                    ->badge(),

                TextColumn::make('duration_hours')
                    ->label('Duración (Horas)')
                    ->numeric()
                    ->sortable()
                    ->alignCenter(),

                TextColumn::make('description')
                    ->label('Descripción')
                    ->limit(50)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('version')
                    ->label('Versión')
                    ->alignCenter()
                    ->badge()
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Creado')
                    ->date('d/m/Y')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime('d/m/Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('competency_type_id')
                    ->label('Tipo de Competencia')
                    ->relationship('competencyType', 'name')
                    ->preload()
                    ->searchable(),
            ])
            ->headerActions([
                CreateAction::make(),
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->recordTitle(fn($record) => "{$record->code} - {$record->name}")
                    ->recordSelectSearchColumns(['code', 'name'])
                    ->label('Vincular Competencia'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DetachAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make()
                        ->action(function ($records, $table) {
                            $relationship = $table->getRelationship();
                            // Aseguramos que sean IDs y no objetos
                            $relationship->detach($records->pluck('id'));
                        }),
                ]),
            ]);
    }
}
