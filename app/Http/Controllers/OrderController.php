<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {

        return view('order.index');
    }

    public function show($id)
    {
        return 'Not Implemented';
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
