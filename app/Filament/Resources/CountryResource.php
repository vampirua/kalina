<?php

namespace App\Filament\Resources;


use App\Models\Country;
use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

    protected static ?string $navigationGroup = 'Параметри';
    protected static ?string $navigationLabel = 'Країна';

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
            'index' => CountryResource\Pages\ListCountries::route('/'),
            'create' => CountryResource\Pages\CreateCountry::route('/create'),
            'edit' => CountryResource\Pages\EditCountry::route('/{record}/edit'),
        ];
    }
}
