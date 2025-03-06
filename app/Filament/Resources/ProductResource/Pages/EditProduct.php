<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ButtonAction::make('Додати варіант')
                ->label('Create Variant')
                ->color('success')
                ->icon('heroicon-o-plus')
                ->url(fn () => route('filament.admin.resources.product-variants.create', ['product_id' => $this->record->id]))
                ->openUrlInNewTab(),
        ];
    }
}
