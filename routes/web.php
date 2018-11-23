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

Route::get('/', ['as' => 'login', 'uses' => 'LoginmasterController@login']);
Route::get('/login.html', ['as' => 'login', 'uses' => 'LoginmasterController@login']);
Route::post('/authlogin', ['as' => 'autlogin', 'uses' => 'LoginmasterController@checklogin']);
Route::get('/logout.html', ['as' => 'logout', 'uses' => 'LoginmasterController@logout']);

// Route::group(['prefix' => 'admin', 'middleware' => 'custom.session'], function () {
Route::group(['prefix' => '', 'middleware' => ['web','throttle:1200,1','custom.session']], function () {
	Route::get('/home/{id?}', ['as' => 'admin.home', 'uses' => 'GameController@gameMaster']);
});