<?php

namespace App\Filament\Resources\FichaInstructorLeaderships;

use App\Filament\Resources\FichaInstructorLeaderships\Pages\ManageFichaInstructorLeaderships;
use App\Models\FichaInstructorLeadership;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FichaInstructorLeadershipResource extends Resource
{
    protected static ?string $model = FichaInstructorLeadership::class;


    protected static ?string $navigationLabel = 'Ficha Instructor ';
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('ficha_id')
                    ->relationship('ficha', 'code')
                    ->required(),
                Select::make('instructor_id')
                    ->relationship('instructor', 'name')
                    ->required(),
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('end_date'),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ficha.code')
                    ->sortable(),
                TextColumn::make('instructor.name')
                    ->sortable(),
                TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageFichaInstructorLeaderships::route('/'),
        ];
    }
}
