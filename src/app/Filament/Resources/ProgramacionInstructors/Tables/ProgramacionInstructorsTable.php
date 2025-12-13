<?php

namespace App\Filament\Resources\ProgramacionInstructors\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Tables\Table;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\ProgramacionInstructors\ProgramacionInstructorResource;
use Illuminate\Database\Eloquent\Model;


class ProgramacionInstructorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->recordUrl(function (Model $record): string {
                // Redirige a la página "manage" en lugar de "edit"
                return ProgramacionInstructorResource::getUrl('manage', ['record' => $record]);
            })
            ->columns([
                ImageColumn::make('photo_url')
                    ->label('')
                    ->disk('public')
                    ->circular()
                    ->toggleable(false),
                TextColumn::make('full_name')
                    ->label('Instructor')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('document_number')
                    ->label('Documento')
                    ->searchable()
                    ->formatStateUsing(fn ($state, $record) => "{$record->document_type} {$record->document_number}"),

                TextColumn::make('executingTeam.name')
                    ->label('Equipo ejecutor')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('specialty')
                    ->label('Especialidad')
                    ->searchable()
                    ->limit(25)
                    //->wrap()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->tooltip(fn($record) => $record->specialty),

                TextColumn::make('email')
                    ->label('Correo')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('phone')
                    ->label('Teléfono')
                    ->searchable()
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
