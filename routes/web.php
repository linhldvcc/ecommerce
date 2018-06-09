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

Route::namespace('Web')->group(function () {
    Route::get('/', 'HomeController@index');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/category/{categoryId}', 'ProductController@getAllProductsByCategory')->name('product.getByCategory');
    Route::get('/product/{productId}', 'ProductController@detail')->name('product.detail');

    Route::post('/cart/add-item', 'CartController@addItem')->name('cart.add-item');

    Route::get('/cart', 'CartController@getItem')->name('cart.get-item');
    Route::get('/cart/order', 'CartController@getOrder')->name('cart.get-order');
});

Auth::routes();