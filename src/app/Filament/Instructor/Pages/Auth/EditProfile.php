<?php

namespace App\Filament\Instructor\Pages\Auth;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

class EditProfile extends BaseEditProfile
{
    public function form(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Información personal')
                ->description('Actualiza tus datos básicos y tu foto de perfil.')
                ->schema([
                    FileUpload::make('photo_url')
                        ->label('Foto de perfil')
                        ->image()
                        ->avatar()
                        ->imageEditor()
                        ->circleCropper()
                        ->directory('instructores')
                        ->disk('public')
                        ->visibility('public')
                        ->maxSize(2048)
                        ->columnSpanFull()
                        ->extraAttributes(['class' => 'mx-auto w-32 h-32']),

                    TextInput::make('name')
                        ->label('Nombre')
                        ->required()
                        ->maxLength(50)
                        ->placeholder('Ej. Carlos'),

                    TextInput::make('last_name')
                        ->label('Apellido')
                        ->required()
                        ->maxLength(50)
                        ->placeholder('Ej. Rodríguez'),

                    TextEntry::make('document_number')
                        ->label('Número de documento')
                        ->color('primary'),

                    TextInput::make('phone')
                        ->label('Teléfono de contacto')
                        ->tel()
                        ->maxLength(15)
                        ->placeholder('Ej. 3201234567'),
                ])
                ->columns(2),


            Section::make('Información profesional')
                ->schema([
                    TextEntry::make('executingTeam.name')
                        ->label('Equipo ejecutor')
                        ->color('primary'),

                    TextInput::make('specialty')
                        ->label('Especialidad')
                        ->maxLength(100)
                        ->placeholder('Ej. Programación, Diseño web, Electricidad...'),
                ])
                ->columns(2),


            Section::make('Datos de acceso')
                ->description('Actualiza tus credenciales de ingreso al sistema.')
                ->schema([
                    $this->getEmailFormComponent(),
                    $this->getPasswordFormComponent(),
                    $this->getPasswordConfirmationFormComponent(),
                    $this->getCurrentPasswordFormComponent(),
                ])
                ->columns(2),
        ]);
    }
}
