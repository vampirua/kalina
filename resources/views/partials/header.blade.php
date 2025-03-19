<header class="bg-dark text-white py-3 sticky-header">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="{{ route('home') }}" class="navbar-brand">Логотип</a>

        <nav>
            <ul class="nav">
                @foreach($categories as $category)
                    <li class="nav-item"><a href="/category/{{$category->slug}}" class="nav-link text-white">{{$category->name}}</a></li>
                @endforeach
            </ul>
        </nav>

        @php
            $cart = session('cart', []);
            $cartCount = array_sum(array_column($cart, 'quantity'));
        @endphp

        <a href="{{ route('cart.index') }}" class="cart-icon">
            🛒 Корзина (<span id="cart-count">{{ $cartCount }}</span>)
        </a>

        <div>
            <a href="#" class="btn btn-outline-light me-2">Реєстрація</a>
            <a href="{{ route('login') }}" class="btn btn-outline-light">Увійти</a>
        </div>
    </div>
</header>
