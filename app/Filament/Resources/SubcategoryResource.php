<?php

namespace App\Filament\Resources;


use App\Filament\Resources\SubcategoryResource\Pages;
use App\Filament\Resources\SubcategoryResource\RelationManagers;
use App\Models\Subcategory;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubcategoryResource extends Resource
{
    protected static ?string $model = Subcategory::class;

    protected static ?string $navigationGroup = 'Категорія';
    protected static ?string $navigationLabel = 'Підкатегорія';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Назва'),
                TextInput::make('slug')
                    ->required()
                    ->unique()
                    ->label('Slug'),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required()
                    ->label('Категорія'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Назва'),
                TextColumn::make('slug')->label('Slug'),
                TextColumn::make('category.name')->label('Категорія'),
                TextColumn::make('created_at')->label('Дата створення')->dateTime(),
            ])
            ->filters([
                // Фільтри для категорій
            ]);
    }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubcategories::route('/'),
            'create' => Pages\CreateSubcategory::route('/create'),
            'edit' => Pages\EditSubcategory::route('/{record}/edit'),
        ];
    }
}
