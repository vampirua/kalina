<?php

namespace App\Filament\Resources;


use App\Models\ProductColor;
use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class ProductColorResource extends Resource
{
    protected static ?string $model = ProductColor::class;

    protected static ?string $navigationGroup = 'Параметри';
    protected static ?string $navigationLabel = 'Колір';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            TextInput::make('name')->label('Назва'),
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
            'index' => ProductColorResource\Pages\ListProductColors::route('/'),
            'create' => ProductColorResource\Pages\CreateProductColor::route('/create'),
            'edit' => ProductColorResource\Pages\EditProductColor::route('/{record}/edit'),
        ];
    }
}
