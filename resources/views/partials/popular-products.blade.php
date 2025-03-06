<div class="text-center">
    <h2>Популярні товари :</h2>
</div>

<div id="popularProductsCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">

        @foreach($products->chunk(4) as $index => $chunk)
            <div class="carousel-item @if($index == 0) active @endif">
                <div class="row">

                    @foreach($chunk as $product)
                        <div class="col-md-3">
                            <div class="card product-card">
                                @if($product->variants->isNotEmpty())
                                    @php
                                        $variant = $product->variants->first();
                                        $image = $variant->images[0] ?? 'default-image.png';
                                    @endphp

                                    <img src="{{ asset('storage/' . $image) }}" class="card-img-top" alt="{{ $product->name }}">
                                @else
                                    <img src="{{ asset('storage/default-image.png') }}" class="card-img-top" alt="No Image">
                                @endif

                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">Ціна: {{ $product->price }} грн</p>
                                    <a href="{{'product/' .$product->slug}}" class="btn btn-primary">Огляд</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#popularProductsCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Попередній</span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#popularProductsCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Наступний</span>
    </button>
</div>
