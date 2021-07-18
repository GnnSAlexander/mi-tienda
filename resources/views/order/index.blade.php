@extends('layout')

@section('title', 'Order Page')

@section('content')
    <h1>My orders</h1>

    <div method="POST" action="{{ route('order') }}">
        <label for="email" class="form-label">Email address</label>
        {!! csrf_field() !!}
        <input
                type="email"
                name="email"
                class="form-control {{ $errors->get('email') ? 'is-invalid':'' }}"
                id="email" placeholder="name@example.com"
                value="{{ old('email') }}"
        >
    </div>

    <button class="search btn btn-primary">Search my orders</button>

    <div class="orders">
        <ul class="list-group">
        </ul>
    </div>

    <script>
            const button = document.querySelector('.search');

            const ul = document.querySelector('.list-group');

            document.addEventListener('DOMContentLoaded', function () {
                button.addEventListener('click', ()=> {
                    ul.innerHTML=''

                    let _token = document.querySelector('input[name="_token"]').value;
                    let email = document.querySelector('input[name="email"]').value;
                    let data = {_token, email}

                    fetch('/search', {
                        method: 'POST',
                        body: JSON.stringify(data),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    }).then(res => {
                        if(!res.ok)  throw Error(res.status)
                        return res.json()
                    })
                        .catch(error => {
                            console.error('Error:', error)
                            return;
                        })
                        .then(response => {

                            if(response.status === 'error'){
                                const li = document.createElement('li');
                                li.className='alert alert-warning'
                                li.innerHTML = response.message;
                                ul.appendChild(li);
                            }
                            const orders = response.orders;

                            if(orders.length === 0){
                                const li = document.createElement('li');
                                li.innerHTML = `There aren't orders`;
                                li.className='list-group-item'
                                ul.appendChild(li);
                            }

                            orders.forEach((order) => {
                                const li = document.createElement('li');
                                const a = document.createElement('a')
                                a.href = '/my-orders/'+order.id
                                li.innerHTML = `(No. ${order.id}) Name: ${order.customer_name}( ${order.customer_email} ) `;
                                li.className='list-group-item'

                                const span = document.createElement('span')
                                span.className = 'badge rounded-pill bg-primary'
                                span.innerHTML = order.status

                                li.appendChild(span)
                                a.appendChild(li)
                                ul.appendChild(a);
                            });
                        })
                })
            }, false);

    </script>


@endsection