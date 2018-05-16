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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('orders', 'OrderAPIController@index');
Route::get('orders/{id}', 'OrderAPIController@show');
Route::post('orders/{id}', 'OrderAPIController@store');
Route::put('orders/(id}', 'OrderAPIController@update');
Route::delete('orders/{id}', 'OrderAPIController@destroy');
