<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __invoke()
    {
        //dd(request()->all());

        $code = request()->code;

        if(!$code or $code != '234' ){
            return 'Doesn\'t have Permission';
        }
        $orders = Order::paginate(15);

        $orders->appends(request()->all());

        return view('admin.index', compact('orders'));
    }
}
