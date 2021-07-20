@extends('layout')

@section('title', 'Checkout Page')

@section('content')
    <h1>Order No({{ $order->id }})</h1>

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

    <div>
        <p>Name: {{ $order->customer_name }}</p>
        <p>Email: {{ $order->customer_email }}</p>
        <p>Phone: {{ $order->customer_mobile }}</p>
        <p>Total: {{ $order->total }}</p>

        <span class="badge rounded-pill {{strtolower($order->status)}} ">{{  $order->status  }}</span>

        <br>
        @if($order->status === 'REJECTED')
            <a class="btn btn-primary" href="{{ route('checkout', ['id'=> $order->id]) }}">Re-Order</a>
        @endif

        @if($order->status === 'CREATED')
            <a class="btn btn-primary" href="{{ $order->payment_url }}">Pay</a>
        @endif
    </div>

@endsection