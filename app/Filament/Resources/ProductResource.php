<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationLabel = 'Продукти';
    protected static ?string $navigationGroup = 'Каталог';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->label('Назва'),
            Forms\Components\TextInput::make('sku')
                ->required()
                ->label('Артикул'),
            Forms\Components\TextInput::make('slug')
                ->required()
                ->label('Псевдонім'),
            Forms\Components\Select::make('type_id')
                ->relationship('type', 'name')
                ->required(),
            Forms\Components\Select::make('unit_id')
                ->relationship('unit', 'name')
                ->required(),
            Forms\Components\Select::make('country_id')
                ->relationship('country', 'name')
                ->required(),
            Forms\Components\Select::make('material_id')
                ->relationship('material', 'name')
                ->required(),
            Forms\Components\Select::make('age_group_id')
                ->relationship('ageGroup', 'name')
                ->required(),
            Forms\Components\Textarea::make('description')
                ->required()
                ->label('Опис'),
            Forms\Components\TextInput::make('image')
                ->required()
                ->label('Фото'),
            Forms\Components\Checkbox::make('status')
                ->label('Статус')
                ->default(true)
                ->required(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->label('Назва')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('sku')->label('Артикул')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('slug')->label('Псевдонім')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('type.name')->label('Тип')->sortable(),
            Tables\Columns\TextColumn::make('unit.name')->label('Одн.вим.')->sortable(),
            Tables\Columns\TextColumn::make('country.name')->label('Карїна')->sortable(),
            Tables\Columns\TextColumn::make('material.name')->label('Матеріал')->sortable(),
            Tables\Columns\TextColumn::make('ageGroup.name')->label('Вікова доступ.')->sortable(),
            Tables\Columns\ImageColumn::make('image')->label('картинка')->sortable(),
            Tables\Columns\BooleanColumn::make('status')->label('Статус')->sortable(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
