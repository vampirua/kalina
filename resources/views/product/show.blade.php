@extends('layouts.app')

@section('title', 'Сторінка продукту')

@section('content')

    <div class="row container">
        <div class="col-md-6">
            <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @if(!empty($product->variants) && $product->variants->isNotEmpty())
                        @php $first = true; @endphp
                        @foreach($product->variants as $variant)
                            @php
                                $image = $variant->images[0] ?? 'default-image.png';
                            @endphp
                            <div class="carousel-item {{ $first ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $image) }}" class="d-block w-100" alt="{{ $product->name }}">
                            </div>
                            @php $first = false; @endphp
                        @endforeach
                    @else
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/default-image.png') }}" class="d-block w-100" alt="No Image">
                        </div>
                    @endif
                </div>

                @if(!empty($product->variants) && $product->variants->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                @endif
            </div>
        </div>


        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <p class="text-muted">{{ $product->description }}</p>
            <h4 class="mt-3">Ціна: <span id="product-price">{{ $product->variants->first()->price }}</span> грн</h4>

            <h6 class="mt-4">Оберіть колір:</h6>
            <div class="d-flex gap-2" id="color-options">
                @foreach($product->variants->groupBy('color_id') as $colorId => $variants)
                    @php
                        $color = $variants->first()->color;
                    @endphp
                    <button
                        class="btn color-btn"
                        style="background: {{ $color->gradient ?? '#ccc' }}; width: 40px; height: 40px; border: 1px solid black; cursor: pointer;"
                        data-color-id="{{ $color->id }}"
                        title="{{ $color->name }}">
                    </button>
                @endforeach
            </div>

            <h6 class="mt-4">Оберіть розмір:</h6>
            <div class="d-flex gap-2" id="size-options">
                @foreach($product->variants->groupBy('size_id') as $sizeId => $variants)
                    @php
                        $size = $variants->first()->size;
                    @endphp
                    <button
                        class="btn size-btn btn-outline-dark"
                        style="padding: 5px 15px; cursor: pointer;"
                        data-size-id="{{ $sizeId }}">
                        {{ $size->name }}
                    </button>
                @endforeach
            </div>

            <div class="product-variant">
                <!-- Загальна ціна -->
                <div class="variant-details">
                        <span class="variant-price" id="variant-price">
                            {{ $product->price }}
                        </span>
                </div>

                <br>
                <div class="quantity-container">
                    <label for="quantity-input">Кількість</label>

                    <div class="quantity-control">
                        <button type="button" id="decrease" class="quantity-btn">-</button>
                        <input type="number" id="quantity-input" value="1" min="1" class="quantity-input">
                        <button type="button" id="increase" class="quantity-btn">+</button>
                    </div>
                </div>

                <br>
                <h4 class="mt-3"> Загальна сума: <span id="total-price">{{ $product->price }} </span></h4>

                <button class="btn btn-primary mt-4" id="add-to-cart" disabled>Замовити в один клік</button>
            </div>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let selectedColor = null;
            let selectedSize = null;
            let selectedQuantity = 1;  // Початкова кількість
            const quantityInput = document.getElementById('quantity-input');
            const increaseButton = document.getElementById('increase');
            const decreaseButton = document.getElementById('decrease');

            // Оновлює ціну та доступність кнопки "Додати до кошика"
            const updatePrice = () => {
                const selectedQuantity = parseInt(quantityInput.value);
                if (selectedColor && selectedSize) {
                    fetch(`/get-variant-price?product_id={{ $product->id }}&color_id=${selectedColor}&size_id=${selectedSize}&quantity=${selectedQuantity}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.price) {
                                const totalPrice = data.price * selectedQuantity;
                                document.getElementById('total-price').textContent = `${totalPrice.toFixed(2)} грн`;
                                document.getElementById('product-price').textContent = data.price;
                            }
                        })
                        .catch(error => console.error('Error fetching price:', error));
                }
            };

            // Фільтрація доступних кольорів в залежності від вибраного розміру
            const filterColors = (sizeId) => {
                fetch(`/get-available-colors?product_id={{ $product->id }}&size_id=${sizeId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.querySelectorAll('.color-btn').forEach(btn => {
                            let available = data.colors.includes(parseInt(btn.dataset.colorId));
                            btn.disabled = !available;
                            btn.style.opacity = available ? "1" : "0.5";
                            btn.style.cursor = available ? "pointer" : "not-allowed";
                        });
                    });
            };

            // Фільтрація доступних розмірів в залежності від вибраного кольору
            const filterSizes = (colorId) => {
                fetch(`/get-available-sizes?product_id={{ $product->id }}&color_id=${colorId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.querySelectorAll('.size-btn').forEach(btn => {
                            let availableSizes = Object.values(data.sizes);
                            let available = availableSizes.includes(parseInt(btn.dataset.sizeId));

                            btn.disabled = !available;
                            btn.style.opacity = available ? "1" : "0.5";
                            btn.style.cursor = available ? "pointer" : "not-allowed";

                            if (available) {
                                btn.classList.remove("disabled");
                            } else {
                                btn.classList.add("disabled");
                            }
                        });
                    });
            };

            // Обробка вибору кольору
            document.querySelectorAll('.color-btn').forEach(button => {
                button.addEventListener('click', function () {
                    if (this.hasAttribute('disabled')) return;

                    document.querySelectorAll('.color-btn').forEach(btn => {
                        btn.style.border = "1px solid black";
                        btn.style.boxShadow = "none";
                        btn.style.opacity = "1";
                    });

                    // Підсвічування вибраного кольору
                    this.style.border = "3px solid blue";
                    this.style.boxShadow = "0px 0px 10px rgba(0, 0, 255, 0.5)";
                    this.style.opacity = "0.8";

                    selectedColor = this.dataset.colorId;
                    updatePrice();
                    filterSizes(selectedColor); // Фільтруємо доступні розміри для обраного кольору
                });
            });

            // Обробка вибору розміру
            document.querySelectorAll('.size-btn').forEach(button => {
                button.addEventListener('click', function () {
                    if (this.hasAttribute('disabled')) return;

                    document.querySelectorAll('.size-btn').forEach(btn => {
                        btn.classList.remove("btn-primary");
                        btn.classList.add("btn-outline-dark");
                    });

                    // Підсвічування вибраного розміру
                    this.classList.remove("btn-outline-dark");
                    this.classList.add("btn-primary");

                    selectedSize = this.dataset.sizeId;
                    updatePrice();
                    filterColors(selectedSize); // Фільтруємо доступні кольори для обраного розміру
                });
            });

            // Обробка зміни кількості товару
            document.getElementById('quantity-input').addEventListener('input', function () {
                selectedQuantity = parseInt(this.value);
                if (selectedQuantity < 1) {
                    selectedQuantity = 1;  // Мінімум 1
                    this.value = 1;
                }
                updatePrice();  // Оновлюємо ціну в залежності від кількості
            });

            increaseButton.addEventListener('click', function () {
                let quantity = parseInt(quantityInput.value);
                quantity++;
                quantityInput.value = quantity;
                updatePrice(); // Оновлюємо ціну при зміні кількості
            });

            // Зменшення кількості
            decreaseButton.addEventListener('click', function () {
                let quantity = parseInt(quantityInput.value);
                if (quantity > 1) {  // Мінімальна кількість 1
                    quantity--;
                    quantityInput.value = quantity;
                    updatePrice(); // Оновлюємо ціну при зміні кількості
                }
            });

            // Оновлення ціни при введенні вручну
            quantityInput.addEventListener('input', function () {
                let quantity = parseInt(this.value);
                if (quantity < 1) quantity = 1;  // Мінімум 1
                this.value = quantity;
                updatePrice(); // Оновлюємо ціну при зміні кількості
            });
        });


    </script>
@endsection
