<?php

namespace App\Livewire\Schedules;

use App\Models\Ficha;
use App\Models\FichaCompetency;
use App\Models\FichaCompetencyExecution;

use Livewire\Component;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Tables\Contracts\HasTable;

use Filament\Actions\DeleteAction;
use App\Filament\Actions\Fichas\EditExecutionAction;
use App\Filament\Actions\Fichas\RegisterExecutionHeaderAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Auth\Pages\Register;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;


class ListExecutions extends Component implements HasTable, HasActions, HasSchemas
{
    use InteractsWithTable;
    use InteractsWithActions;
    use InteractsWithSchemas;

    public function table(Table $table): Table
    {
        return $table
            ->query(FichaCompetencyExecution::query())

            ->columns([
                ImageColumn::make('instructor.photo_url')
                    ->label('')
                    ->disk('public')
                    ->circular()
                    ->toggleable(),
                TextColumn::make('instructor.full_name')
                    ->label('Instructor')
                    ->searchable(),
                TextColumn::make('FichaCompetency.ficha.code')
                    ->label('Ficha')
                    ->searchable(),
                TextColumn::make('FichaCompetency.competency.name')
                    ->label('Competencia'),
                TextColumn::make('FichaCompetency.ficha.program.name')
                    ->label('Programa')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('executed_hours')
                    ->label('Horas Ejecutadas'),
                TextColumn::make('execution_date')
                    ->label('Fecha de Ejecución')
                    ->date('d/F/Y'),
                TextColumn::make('completion_date')
                    ->label('Fecha de Finalización')
                    ->date('d/F/Y'),
            ])
            ->filters([
                SelectFilter::make('program')
                    ->label('Programa')
                    ->relationship('FichaCompetency.ficha.program', 'name'),
            ]);


    }
    
    public function render()
    {
        return view('livewire.schedules.list-executions');
    }
}
