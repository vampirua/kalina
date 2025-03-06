@extends('layouts.app')

@section('title', 'Головна')

@section('content')



        <div class="popular-products py-5 bg-light">
            @include('partials.popular-products', ['products' => $popularProducts])
        </div>

@endsection
