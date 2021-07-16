<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Src\Models\Product;

class CheckoutController extends Controller
{

    function create()
    {
        $products = [
            new Product() // it load an product for default
        ];

        //dd(Order::all());

        return view('checkout.create', compact(['products']));
    }

    function store()
    {
        //$this->paymentGateway->processURL();


        $data = request()->validate([
            'name' => 'required|min:3|max:80',
            'email' => 'required|email|max:120',
            'phone' => 'required|numeric',
            'total' => 'required',
            'currency'=> 'required'
        ]);

        $order = Order::create([
            'customer_name' => $data['name'],
            'customer_email' => $data['email'],
            'customer_mobile' => $data['phone'],
            'total' => $data['total'],
            'currency' => $data['currency'],
        ]);

        return redirect(route('summary',['order' => $order]));
    }
}
