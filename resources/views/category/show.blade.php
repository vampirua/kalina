@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <!-- Блок фільтрів зліва -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Фільтри</div>
                    <div class="card-body">
                        <form action="{{ route('categories.show', $category->slug) }}" method="GET">
                            <!-- Фільтри за підкатегорією -->
                            <div class="form-group">
                                <label for="subcategory_id">Підкатегорія</label>
                                <select name="subcategory_id" id="subcategory_id" class="form-control">
                                    <option value="">Вибрати підкатегорію</option>
                                    @foreach($category->subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}" {{ request()->get('subcategory_id') == $subcategory->id ? 'selected' : '' }}>
                                            {{ $subcategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Фільтри за ціною -->
                            <div class="form-group mt-3">
                                <label for="price_from">Ціна від</label>
                                <input type="number" name="price_from" id="price_from" class="form-control" value="{{ request()->get('price_from') }}">
                            </div>
                            <div class="form-group mt-3">
                                <label for="price_to">Ціна до</label>
                                <input type="number" name="price_to" id="price_to" class="form-control" value="{{ request()->get('price_to') }}">
                            </div>

                            <!-- Кнопка фільтрації -->
                            <button type="submit" class="btn btn-primary mt-3">Застосувати фільтри</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Блок товарів справа -->
            <div class="col-md-9">
                <h2>{{ $category->name }}</h2>
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-md-4">
                            <div class="card">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('storage/default-image.png') }}" class="card-img-top" alt="{{ $product->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                                    <p class="card-text">{{ $product->price }} грн</p>
                                    <a href="{{ route('product.show', $product->slug) }}" class="btn btn-primary">Переглянути</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Пагінація -->
                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
