@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <!-- Ліва частина: Слайдер з фото -->
            <div class="col-md-6">
                <div id="productImagesCarousel" class="carousel slide product-carousel" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($product->variants as $variant)
                            @if($variant->images && is_array($variant->images) && count($variant->images) > 0)
                                @foreach($variant->images as $index => $image)
                                    <div class="carousel-item @if($index == 0) active @endif">
                                        <img src="{{ asset('storage/' . $image) }}" class="d-block w-100 product-carousel-img" alt="{{ $product->name }}">
                                    </div>
                                @endforeach
                            @else
                                <div class="carousel-item active">
                                    <img src="{{ asset('storage/default-image.png') }}" class="d-block w-100 product-carousel-img" alt="Default Image">
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#productImagesCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productImagesCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <!-- Права частина: Опис продукту -->
            <div class="col-md-6">
                <h2>{{ $product->name }}</h2>
                <p class="mt-3">{{ $product->description }}</p>
                <h5>Ціна: {{ $product->price }} грн</h5>

                <!-- Варіанти продукту -->
                @if($product->variants->isNotEmpty())
                    <h6 class="mt-4">Варіанти:</h6>
                    <ul>
                        @foreach($product->variants as $variant)
                            <li>{{ $variant->size->name }} / {{ $variant->color->name }} — {{ $variant->price }} грн</li>
                        @endforeach
                    </ul>
                @endif

                <!-- Кнопка додавання в кошик -->
                <div class="mt-4">
                    <button class="btn btn-primary">Додати в кошик</button>
                </div>
            </div>
        </div>

        <!-- Блок схожих товарів -->
        <div class="container mt-5">
            <h3 class="text-center mb-4">Схожі товари</h3>
            <div id="similarProductsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($similarProducts as $index => $product)
                        <div class="carousel-item @if($index == 0) active @endif">
                            <div class="card">
                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ $product->description }}</p>
                                    <h6>Ціна: {{ $product->price }} грн</h6>
                                    <a href="{{ route('product.show', $product->slug) }}" class="btn btn-outline-primary">Детальніше</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#similarProductsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#similarProductsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
@endsection
