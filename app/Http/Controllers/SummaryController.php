<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Src\Models\Product;

class SummaryController extends Controller
{
    function index(Order $order)
    {
        $products = [new Product()];
        return view('summary.index',compact(['order', 'products']));
    }
}