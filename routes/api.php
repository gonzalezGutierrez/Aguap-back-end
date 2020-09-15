<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('v1/register', 'UserController@store');

Route::middleware(['middleware'=>'auth:api'])->group(function () {
    Route::get('v1/user/{id}','UserController@show');
    Route::put('v1/user/{id}','UserController@update');

    Route::post('v1/ubication','UbicationController@store');
    Route::get('v1/ubication','UbicationController@index');
    Route::delete('v1/ubication/{id}','UbicationController@destroy');
});