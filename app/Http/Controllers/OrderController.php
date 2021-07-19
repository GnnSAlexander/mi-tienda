<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Src\Models\Product;

class OrderController extends Controller
{
    public function index()
    {

        return view('order.index');
    }

    public function show(Order $order)
    {
        $products = [new Product()];
        return view('order.show', compact(['order','products']));
    }

    public function search()
    {
        $email = request()->email;

        if($email == ''){
            $response = array(
                'status' => 'error',
                'message' => 'The email is required',
            );
            return response()->json($response);
        }

        $orders = Order::where('customer_email', $email )->get();


        $response = array(
            'status' => 'success',
            'orders' => $orders,
        );
        return response()->json($response);
    }

}
