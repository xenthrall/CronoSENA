<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\IconColumn;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Correo electrónico')
                    ->searchable(),
                TextColumn::make('roles.name') // relación Spatie
                    ->label('Rol')
                    ->badge()
                    ->colors([
                        'primary' => 'admin',
                        'success' => 'viewer',
                    ])
                    ->sortable(),

                IconColumn::make('email_verified_at')
                    ->label('Verificado')
                    ->default(false)
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Creado en')
                    ->dateTime('d M, Y h:i A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Actualizado en')
                    ->dateTime('d M, Y h:i A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->visible(fn() => auth()->user()?->can('user.edit')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                   
                ]),
            ]);
    }
}
