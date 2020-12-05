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



Route::get('v1/user/email','UserController@findEmail');
Route::post('v1/register', 'UserController@store');
Route::post('v1/user/recoverAccount','UserController@AccountRecoveryEmail');
Route::post('v1/rol/register','RolController@store');


Route::middleware(['middleware'=>'auth:api'])->group(function () {
    Route::get('v1/user/activate/{id}','UserController@userAccountActivation');
    Route::get('v1/user/{id}','UserController@show');
    Route::get('v1/user/verificationPassword/{id}','UserController@checkMyCurrentpassword');
    Route::put('v1/user/updateUser/{id}','UserController@updateUser');
    Route::put('v1/user/updatePassword/{id}','UserController@updatePassword');
    Route::delete('v1/user/delete/{id}','UserController@destroy');

    Route::post('v1/ubication','UbicationController@store');
    Route::get('v1/ubication/{id}','UbicationController@show');
    Route::delete('v1/ubication/{id}','UbicationController@destroy');

    Route::post('v1/account','AccountController@store');
    Route::get('v1/account/{id}','AccountController@show');
    Route::delete('v1/account/{id}','AccountController@destroy');

    //Admin
    Route::get('v1/rol/{id}','RolController@show');
    /**RUTAS DE SALVA */
    Route::post('v1/supplie/', 'SuppliesController@store');
    Route::post('v1/supplier/', 'SuppliersController@store');
    Route::get('v1/supplie/','SuppliesController@index');
    Route::get('v1/supplier/','SuppliersController@index');
    Route::get('v1/supplie/{id}','SuppliesController@show');
    Route::get('v1/supplier/{id}','SuppliersController@show');
    Route::delete('v1/supplie/{id}','SuppliesController@destroy');
    Route::delete('v1/supplier/{id}','SuppliersController@destroy');
    Route::put('v1/supplie/{id}','SuppliesController@update');
    Route::put('v1/supplier/{id}','SuppliersController@update');
    
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

   
    
     

