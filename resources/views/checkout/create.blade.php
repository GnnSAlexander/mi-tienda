@extends('layout')

@section('title', 'Checkout Page')

@section('content')
    <h1>Checkout Page</h1>

    <table class="table table-dark table-borderless">
        <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>

        </tr>
        </thead>
        <tbody>
        @foreach( $products as $product )
            <tr>
                <th scope="row"></th>
                <td><img src="{{ $product->image }}" class="img-responsive table-img" alt="{{ $product->name }}"></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <h2>Billing Information</h2>
    <form method="POST" action="{{ route('checkout') }}">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="text" placeholder="Pepito Perez">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Email address</label>
            <input
                    type="tel"
                    id="phone"
                    class="form-control"
                    name="phone"
                    pattern="[0-9]{3}-[0-9]{4}-[0-9]{3}"
                    placeholder="123-1234-123"
            >
        </div>
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" checked value="placetopay" id="placetopay">
                <label class="form-check-label" for="placetopay">
                    PlaceToPay
                </label>
            </div>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Buy</button>
        </div>
    </form>

@endsection