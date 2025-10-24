<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('email_verified_at')
                    ->label('Verificado')
                    ->disabled(),
                TextInput::make('password')
                    ->password()
                    ->required(),
                Select::make('roles')
                    ->label('Rol')
                    ->multiple()
                    ->relationship('roles', 'name')
                    ->preload()
                    ->required(),
                
                
            ]);
    }
}
