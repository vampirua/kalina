<?php

namespace App\Filament\Resources;


use App\Models\Material;
use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class MaterialResource extends Resource
{
    protected static ?string $model = Material::class;

    protected static ?string $navigationGroup = 'Параметри';
    protected static ?string $navigationLabel = 'Матеріал';

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
            'index' => MaterialResource\Pages\ListMaterials::route('/'),
            'create' => MaterialResource\Pages\CreateMaterial::route('/create'),
            'edit' => MaterialResource\Pages\EditMaterial::route('/{record}/edit'),
        ];
    }
}
