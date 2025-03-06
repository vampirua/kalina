<?php

namespace App\Filament\Resources;


use App\Models\ProductSize;
use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class ProductSizeResource extends Resource
{
    protected static ?string $model = ProductSize::class;

    protected static ?string $navigationGroup = 'Параметри';
    protected static ?string $navigationLabel = 'Розмір';

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
            'index' => ProductSizeResource\Pages\ListProductSizes::route('/'),
            'create' => ProductSizeResource\Pages\CreateProductSize::route('/create'),
            'edit' => ProductSizeResource\Pages\EditProductSize::route('/{record}/edit'),
        ];
    }
}
