<?php

namespace App\Filament\Instructor\Pages\Auth;

use Filament\Auth\Pages\Login;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InstructorLogin extends Login
{
    protected string $view = 'filament.instructor.pages.auth.instructor-login';


    public function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('email')
                ->label('Correo electrónico')
                ->email(),
            TextInput::make('password')
                ->label('Contraseña')
                ->password(),
        ]
        );
    }
}
