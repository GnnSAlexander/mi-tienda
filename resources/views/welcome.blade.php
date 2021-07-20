@extends('layout')

@section('title', 'Home')

@section('content')
    <h1>The Bestsellers</h1>
    <div class="card">
        <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text">{{ $product->description }}</p>
            <p class="card-text">Price: {{ priceFormat($product->price) }}</p>
            <a href="{{ route('checkout') }}" class="btn btn-primary">Buy with PlaceToPay</a>
        </div>
    </div>
@endsection