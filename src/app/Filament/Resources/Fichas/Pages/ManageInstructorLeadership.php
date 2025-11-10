<?php

namespace App\Filament\Resources\Fichas\Pages;

use App\Filament\Resources\Fichas\FichaResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

use Illuminate\Support\Facades\Auth;

use App\Filament\Actions\InstructorLeader\CreateInstructorLeadership;

class ManageInstructorLeadership extends Page
{
    use InteractsWithRecord;

    protected static string $resource = FichaResource::class;

    protected string $view = 'filament.resources.fichas.pages.manage-instructor-leadership';

    protected static ?string $title = 'Gestionar Instructor Líder de la Ficha';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
        $this->authorizeAccess();
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateInstructorLeadership::make()
                ->visible(fn () => $this->record->currentLeader() === null),
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
