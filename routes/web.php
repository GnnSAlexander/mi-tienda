<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Src\Models\Product;

Route::get('/', function () {
    $product = new Product();
    return view('welcome', compact(['product']));
})->name('home');

///CheckOutController

Route::get('/checkout/{id?}', 'CheckoutController@create')->name('checkout');

Route::POST('/checkout/', 'CheckoutController@store')->name('checkout.store');

///SummaryController

Route::get('/checkout/summary/{order}', 'SummaryController')->name('summary');


///OrderController

Route::get('/my-orders','OrderController@index')->name('order');

Route::get('/my-orders/{id}','OrderController@show')->name('order.show');

Route::post('/search','OrderController@search')->name('order.search');

//AdminController

Route::get('/admin/orders', 'AdminController')->name('admin');

