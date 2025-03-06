<?php

namespace App\Filament\Resources;


use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class ProductVariantResource extends Resource
{
    protected static ?string $model = ProductVariant::class;
    protected static ?string $navigationLabel = 'Варіант';
    protected static ?string $navigationGroup = 'Каталог';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('price')
                    ->label('Ціна')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->label('Кількість')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('min_quantity')
                    ->label('Мінімальна к-сть.')
                    ->numeric()
                    ->required(),
                Forms\Components\Select::make('color_id')
                    ->label('Колір')
                    ->options(ProductColor::all()->pluck('name', 'id'))
                    ->required(),
                Forms\Components\FileUpload::make('image')
                    ->multiple()
                    ->image()
                    ->directory('product-variants')
                    ->maxSize(2048)
                    ->columnSpanFull()
                    ->label('Фото'),
                Forms\Components\Select::make('size_id')
                    ->label('Розмір')
                    ->options(ProductSize::all()->pluck('name', 'id'))
                    ->required(),

            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Назва продукта'),
                Tables\Columns\TextColumn::make('price')
                    ->label('Ціна'),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('Кількість'),
                Tables\Columns\TextColumn::make('min_quantity')
                    ->label('Мінімальна к-сть.'),
                Tables\Columns\TextColumn::make('color_id')
                    ->label('Колір'),
                Tables\Columns\TextColumn::make('size_id')
                    ->label('Розмір'),
                Tables\Columns\ImageColumn::make('image')
                    ->size(50),
            ])
            ->filters([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ProductVariantResource\Pages\ListProductVariants::route('/'),
            'create' => ProductVariantResource\Pages\CreateProductVariant::route('/create/{product_id}'),
            'edit' => ProductVariantResource\Pages\EditProductVariant::route('/{record}/edit'),
        ];
    }
}
