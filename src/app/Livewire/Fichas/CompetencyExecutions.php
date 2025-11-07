<?php

namespace App\Livewire\Fichas;

use App\Models\Ficha;
use App\Models\FichaCompetency;
use App\Models\FichaCompetencyExecution;

use Livewire\Component;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Tables\Contracts\HasTable;

use Filament\Actions\DeleteAction;
use App\Filament\Actions\Fichas\EditExecutionAction;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;


class CompetencyExecutions extends Component implements HasActions, HasSchemas, HasTable
{

    use InteractsWithActions;
    use InteractsWithSchemas;
    use InteractsWithTable;

    public FichaCompetency $fichaCompetency;

    public function table(Table $table): Table
    {
        return $table
            ->query(FichaCompetencyExecution::query()->where('ficha_competency_id', $this->fichaCompetency->id))

            ->columns([
                ImageColumn::make('instructor.photo_url')
                    ->label('')
                    ->disk('public')
                    ->circular()
                    ->toggleable(false),
                TextColumn::make('instructor.full_name')
                    ->label('Instructor'),
                TextColumn::make('executed_hours')
                    ->label('Horas Ejecutadas'),
                TextColumn::make('execution_date')
                    ->label('Fecha de Ejecución'),
                TextColumn::make('completion_date')
                    ->label('Fecha de Finalización'),
            ])

            ->recordActions([
                DeleteAction::make(),
                EditExecutionAction::make(),
            ]);
    }

    public function render()
    {
        return view('livewire.fichas.competency-executions');
    }
}
