<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Головна')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>
    @stack('styles')
</head>
<body>

@include('partials.header')
<div class="container">
@if(request()->routeIs('home'))
<div class="slider-container">
    @include('partials.slider')
</div>
@endif


@yield('content')
    <br>
    @include('partials.info')
</div>
@include('partials.footer')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/cart.js') }}"></script>
@stack('scripts')
</body>
</html>
