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

Route::get('/checkout', 'CheckoutController@create')->name('checkout');

Route::POST('/checkout', 'CheckoutController@store')->name('checkout.store');

Route::get('/checkout/summary/{order}', 'SummaryController@index')->name('summary');

