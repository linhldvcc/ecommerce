<?php

// use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "admin" middleware group. Enjoy building your Admin!
|
*/

Route::namespace('Admin')->group(function () {
    Route::group(['middleware' => ['auth.admin']],  function () {
        Route::get('/', 'HomeController@index');

        Route::resource('category', 'CategoryController');
        Route::resource('product', 'ProductController');

        Route::post('product/upload_image/{id}', 'ProductImageController@uploadImage')
            ->name('product_image.upload');

        Route::post('product/delete_image/{id}', 'ProductImageController@deleteImage')
            ->name('product_image.delete');

        Route::get('product/get_all_image/{id}', 'ProductImageController@getAllImageOfProduct')
            ->name('product_image.get_all');
    });
});
