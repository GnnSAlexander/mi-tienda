@extends('layout')

@section('title', 'Admin Page')

@section('content')
    <h1>Admin</h1>

    <h3>Orders</h3>
    <div class="orders">
        <ul class="list-group">
            @foreach( $orders as $order)
                <li class="list-group-item">
                    (No. {{$order->id}}) {{ $order->customer_name }}( {{  $order->customer_email }} ) {{ priceFormat($order->total) }}
                    <span class="badge rounded-pill {{strtolower($order->status)}} "
                    >{{  $order->status  }}</span>
                </li>
            @endforeach
        </ul>
        {{ $orders->links() }}
    </div>



@endsection