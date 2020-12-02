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
Route::get('v1/user/email','UserController@findEmail');

Route::middleware(['middleware'=>'auth:api'])->group(function () {
    Route::get('v1/user/{id}','UserController@show');
    Route::put('v1/user/{id}','UserController@update');
    Route::post('v1/ubication','UbicationController@store');
    Route::get('v1/ubication','UbicationController@index');
    Route::delete('v1/ubication/{id}','UbicationController@destroy');
});


Route::group(['prefix'=>'v1'],function(){


    Route::group(['prefix'=>'resources'],function(){


        Route::get('repartidores',[\App\Http\Controllers\Api\V1\ResourcesApi\UsuariosRepartidoresController::class,'index']);


        Route::get('ubicaciones',[\App\Http\Controllers\Api\V1\ResourcesApi\UbicacionesClientesController::class,'index']);


        Route::get('servicios',[\App\Http\Controllers\Api\V1\ResourcesApi\ServiciosController::class,'index']);

        Route::post('ordenes',[\App\Http\Controllers\Api\V1\ResourcesApi\OrderController::class,'store']);
        Route::patch('ordenes/update-repartidor',[\App\Http\Controllers\Api\V1\ResourcesApi\OrderController::class,'updateRepartidor']);
        Route::patch('ordenes/update-ubicacion',[\App\Http\Controllers\Api\V1\ResourcesApi\OrderController::class,'updateUbicacion']);
        Route::patch('ordenes/update-fecha',[\App\Http\Controllers\Api\V1\ResourcesApi\OrderController::class,'updateFecha']);



        Route::get('orden',[\App\Http\Controllers\Api\V1\ResourcesApi\OrderController::class,'show']);

        Route::post('orden/add-servicio',[\App\Http\Controllers\Api\V1\ResourcesApi\OrderController::class,'addServicio']);

    });

});
