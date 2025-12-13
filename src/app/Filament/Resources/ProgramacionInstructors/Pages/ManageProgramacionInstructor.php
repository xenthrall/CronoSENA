<?php
namespace App\Filament\Resources\ProgramacionInstructors\Pages;

use App\Filament\Resources\ProgramacionInstructors\ProgramacionInstructorResource;
use Filament\Resources\Pages\Page;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use App\Filament\Actions\Programacion\Instructors\RegisterExecutionHeaderAction;
use Livewire\Attributes\On;
use App\Filament\Actions\Programacion\Instructors\ShowExecutionTestAction;

class ManageProgramacionInstructor extends Page
{
    use InteractsWithRecord;

    protected static string $resource = ProgramacionInstructorResource::class;

    protected string $view = 'filament.resources.schedules.instructors.pages.manage-programacion-instructor';

    protected static ?string $title = 'Programación del instructor';



    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }

    protected function getHeaderActions(): array
    {
        return [
            RegisterExecutionHeaderAction::make()
                ->instructor($this->record->id),
            ShowExecutionTestAction::make(),
        ];
    }

     #[On('openExecutionAction')]
    public function openExecutionAction(int $executionId): void
    {
        // Por ahora ignoramos el ID, solo abrimos el modal
        $this->mountAction('showExecutionTest');
    }
    
}