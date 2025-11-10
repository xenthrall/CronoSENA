<?php

namespace App\Filament\Resources\Fichas\Pages;

use App\Filament\Resources\Fichas\FichaResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Filament\Actions\Action;

class ManageFicha extends Page
{
    use InteractsWithRecord;

    protected static string $resource = FichaResource::class;

    protected string $view = 'filament.resources.fichas.pages.manage-ficha';

    protected static ?string $title = 'Gestionar ficha';

    //protected static ?string $breadcrumb = 'Gestionar ficha';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
        $this->authorizeAccess();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Instructor Líder de la Ficha')
                ->label('Instructor Líder de la Ficha')
                ->icon('heroicon-o-user')
                ->badge()
                ->color('info')
                ->url($this->getResource()::getUrl('manage-instructor-leadership', ['record' => $this->record]))
        ];
    }

    protected function authorizeAccess(): void
    {
        abort_unless(
            Auth::user()?->can('ficha.manage'),
            403,
            'No tienes permiso para gestionar esta ficha.'
        );
    }
}
