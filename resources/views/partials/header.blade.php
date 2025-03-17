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
        <div>
            <a href="#" class="btn btn-outline-light me-2">Реєстрація</a>
            <a href="{{ route('login') }}" class="btn btn-outline-light">Увійти</a>
        </div>
    </div>
</header>
