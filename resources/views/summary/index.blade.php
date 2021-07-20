@extends('layout')

@section('title', 'Checkout Page')

@section('content')
    <h1>Summary page</h1>

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
                <td>{{ priceFormat($product->price) }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <div>
       <p>Name: {{ $order->customer_name }}</p>
        <p>Email: {{ $order->customer_email }}</p>
        <p>Phone: {{ $order->customer_mobile }}</p>
        <p>Total: {{ priceFormat($order->total) }}</p>

        <a href="{{ $urlToPayment }}" class="btn btn-primary">Pay</a>
    </div>

@endsection