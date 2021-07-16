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
    <form method="POST" action="{{ route('checkout.store') }}">
        {{ csrf_field() }}

        <input type="hidden" name="total" value="{{ $product->price }}">
        <input type="hidden" name="currency" value="{{ config('store.currency') }}">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input
                    type="text"
                    name="name"
                    class="form-control {{ $errors->get('name') ? 'is-invalid':'' }}"
                    id="text" placeholder="Pepito Perez"
                    value="{{ old('name') }}"
            >
            @if( $errors->get('name'))
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input
                    type="email"
                    name="email"
                    class="form-control {{ $errors->get('email') ? 'is-invalid':'' }}"
                    id="email" placeholder="name@example.com"
                    value="{{ old('email') }}"
            >
            @if( $errors->get('email'))
                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Email address</label>
            <input
                    type="tel"
                    id="phone"
                    class="form-control {{ $errors->get('phone') ? 'is-invalid':'' }}"
                    name="phone"
                    pattern="[0-9]{10}"
                    placeholder="1234567890"
                    value="{{ old('phone') }}"
            >
            @if( $errors->get('phone'))
                <div class="invalid-feedback">
                    {{ $errors->first('phone') }}
                </div>
            @endif
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
            <button type="submit" class="btn btn-primary">Order</button>
        </div>
    </form>

@endsection