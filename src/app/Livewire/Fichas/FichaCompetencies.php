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
use App\Filament\Actions\Fichas\RegisterExecutionAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Support\Icons\Heroicon;

use Filament\Actions\ActionGroup;
use App\Filament\Actions\Fichas\ManageNotesAction;

use App\Filament\Resources\Fichas\FichaResource;
use Illuminate\Database\Eloquent\Model;

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
            ->recordUrl(function (Model $record): string {
                return FichaResource::getUrl('competency-executions', [
                    'ficha' => $this->ficha->id,
                    'ficha_competency' => $record,           // el registro actual de la tabla
                ]);
            })
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
                TextColumn::make('progress_percentage')
                    ->label('Estado (%)')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('competency.competencyType.name')
                    ->label('Tipo de Competencia')
                    ->default('Sin asignar')
                    ->badge()
                    ->colors([
                        'gray'    => fn($state): bool => $state === 'Sin asignar', // si no tiene tipo asignado
                    ])
                    ->toggleable(isToggledHiddenByDefault: false),
                IconColumn::make('notes')
                    ->label('Observaciones')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean()
                    ->state(fn($record) => !empty($record->notes))
                    ->trueIcon(Heroicon::ExclamationCircle)
                    ->falseIcon(Heroicon::CheckCircle)
                    ->trueColor('warning')
                    ->falseColor('gray')
                    ->tooltip(fn($record) => $record->notes ? 'Tiene observaciones' : 'Sin Observaciones')
                    ->action(ManageNotesAction::make()),
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
                        //->visible(fn (Model $record): bool => $record->notes? true : false),
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.fichas.ficha-competencies');
    }
}
