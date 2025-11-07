<?php

namespace App\Livewire\Fichas;

use App\Models\Ficha;
use App\Models\FichaCompetency;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Actions\RegisterExecutionAction;
use Filament\Actions\ActionGroup;

class FichaCompetencies extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithSchemas;
    use InteractsWithTable;

    // Recibirá la ficha actual desde la vista
    public Ficha $ficha;

    public function table(Table $table): Table
    {
        return $table
            ->query(FichaCompetency::query()->where('ficha_id', $this->ficha->id))
            ->columns([
                TextColumn::make('order')
                    ->label('Orden de ejecución')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('competency.code')
                    ->label('Código')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('competency.name')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(fn($record) => $record->competency->name)
                    ->label('Competencia'),
                TextColumn::make('total_hours_competency')
                    ->label('Horas totales'),
                TextColumn::make('executed_hours')
                    ->label('Horas ejecutadas'),
                TextColumn::make('remaining_hours')
                    ->label('Horas restantes'),
                TextColumn::make('status')
                    ->label('Estado'),
                TextColumn::make('competency.competencyType.name')
                    ->label('Tipo de Competencia')
                    ->default('Sin asignar')
                    ->badge()
                    ->colors([
                        'gray'    => fn($state): bool => $state === 'Sin asignar', // si no tiene tipo asignado
                    ])
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('notes')
                    ->label('Notas')
                    ->limit(25)
                    ->tooltip(fn($record) => $record->notes)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //Filtrar por tipo de competencia
                SelectFilter::make('competency.competencyType_id')
                    ->label('Tipo de Competencia')
                    ->relationship('competency.competencyType', 'name', hasEmptyOption: true)
                    ->emptyRelationshipOptionLabel('Sin asignar'),

            ])

            ->recordActions([
                ActionGroup::make([
                    RegisterExecutionAction::make(),
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.fichas.ficha-competencies');
    }
}
