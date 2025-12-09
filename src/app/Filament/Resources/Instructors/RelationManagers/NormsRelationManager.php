<?php

namespace App\Filament\Resources\Instructors\RelationManagers;

use App\Filament\Resources\Norms\NormResource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\ViewAction;
use Illuminate\Support\Facades\Auth;


class NormsRelationManager extends RelationManager
{
    protected static string $relationship = 'norms';

    protected static ?string $relatedResource = NormResource::class;

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

                TextColumn::make('description')
                    ->label('Descripción')
                    ->limit(50)
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
                //
            ])
            ->headerActions([
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->recordTitle(fn($record) => "{$record->code} - {$record->name}")
                    ->recordSelectSearchColumns(['code', 'name'])
                    ->label('Vincular Norma'),
            ])
            ->recordActions([
                ViewAction::make(),
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
