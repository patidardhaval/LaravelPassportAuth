<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', 'Api\PassportController@login');
Route::post('register', 'Api\PassportController@register');

Route::middleware('auth:api')->group(function () {
    Route::get('user', 'Api\PassportController@details');

    Route::resource('products', 'Api\ProductController');
});
