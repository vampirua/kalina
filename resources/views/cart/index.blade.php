@extends('layouts.app')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row container">
        <h1>🛒 Ваша корзина</h1>

        @if (empty($cart))
            <p>Ваша корзина порожня.</p>
        @else
            <div class="cart-items">
                @foreach(session('cart') as $key => $item)
                    <div class="cart-item">
                        <div class="cart-item-details">
                            <div class="cart-item-images">
                                @foreach(array_slice($item['variant_images'], 0, 5) as $image)
                                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $item['product_name'] }}"
                                         class="cart-item-image">
                                @endforeach
                            </div>
                            <div class="cart-item-info">
                                <h5>{{ $item['product_name'] }}</h5>
                                <p>Кількість: {{ $item['quantity'] }}</p>
                                <p>Ціна: {{ $item['variant_price'] }} грн</p>
                            </div>
                        </div>
                        <button class="btn btn-danger remove-from-cart" data-key="{{ $key }}">Видалити з корзини
                        </button>
                    </div>
                @endforeach
            </div>



            <button id="clear-cart">Очистити корзину</button>
        @endif

        <a href="/">⬅ Назад до покупок</a>
    </div>
@endsection
