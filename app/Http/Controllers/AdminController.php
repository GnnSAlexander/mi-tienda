<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __invoke()
    {
        $code = request()->code;

        if(!$code or $code != config('store.code') ){
            return 'Doesn\'t have Permission';
        }
        $orders = Order::paginate(15);

        $orders->appends(request()->all());

        return view('admin.index', compact('orders'));
    }
}
