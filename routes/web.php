<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::resource('_proveedores','\App\Http\Controllers\SuppliersController');
Route::post('_update_proveedor','\App\Http\Controllers\SuppliersController@actualizar')->name('_update_proveedor.actualizar');

Route::resource('_insumos','\App\Http\Controllers\SuppliesController');
Route::post('_update_insumos','\App\Http\Controllers\SuppliesController@actualizar')->name('_update_insumos.actualizar');

Route::group(['prefix'=>'administracion'],function(){
    Route::get('pedidos',[\App\Http\Controllers\PedidosController::class,'index']);
    Route::get('proveedores',[\App\Http\Controllers\SuppliersController::class, 'index']);
    Route::get('insumos',[\App\Http\Controllers\SuppliesController::class, 'index']);
});

Route::get('login',[\App\Http\Controllers\AuthController::class,'login']);
Route::post('login',[\App\Http\Controllers\AuthController::class,'auth']);
