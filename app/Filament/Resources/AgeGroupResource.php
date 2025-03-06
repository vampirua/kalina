<?php

namespace App\Filament\Resources;


use App\Models\AgeGroup;
use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class AgeGroupResource extends Resource
{
    protected static ?string $model = AgeGroup::class;

    protected static ?string $navigationGroup = 'Параметри';
    protected static ?string $navigationLabel = 'Вікова група';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            TextInput::make('name')->label('Назва')->required(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Назва'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => AgeGroupResource\Pages\ListAgeGroups::route('/'),
            'create' => AgeGroupResource\Pages\CreateAgeGroup::route('/create'),
            'edit' => AgeGroupResource\Pages\EditAgeGroup::route('/{record}/edit'),
        ];
    }
}
