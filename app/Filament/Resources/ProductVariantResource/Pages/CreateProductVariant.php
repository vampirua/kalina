<?php

namespace App\Filament\Resources\ProductVariantResource\Pages;

use App\Filament\Resources\ProductVariantResource;
use App\Models\ProductVariant;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms;

class CreateProductVariant extends CreateRecord
{
    protected static string $resource = ProductVariantResource::class;

    public $product_id;

    public function mount(): void
    {
        $this->product_id = request()->route('product_id'); // ініціалізуємо значення
    }

    // Якщо потрібно додати іншу логіку перед збереженням:
    public function mutateFormDataBeforeCreate(array $data): array
    {
        $data['product_id'] = $this->product_id;
        return $data;

    }
}

