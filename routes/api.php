<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PedidosController;
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

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;

//================================ PRODUCTOS =============================================

Route::middleware('throttle:30,1')->group(function () {
  Route::get('/productos', [ProductoController::class, 'index']);

  Route::get('/productos/{id_producto}', [ProductoController::class,'show']);
});

Route::middleware('auth:admin')->group(function () {

  Route::post('/productos', [ProductoController::class, 'store']);

  Route::put('/productos/{id_producto}', [ProductoController::class,'update']);

  Route::patch('/productos/{id_producto}', [ProductoController::class,'edit']);

  Route::delete('/productos/{id_producto}',[ProductoController::class,'destroy']);

});



Route::middleware('auth:admin')->group(function () {
  Route::get('/pedidos', [PedidosController::class, 'index']);
});

Route::middleware('auth:api')->group(function () {
  Route::get('/pedidos/usuario', [PedidosController::class, 'getOrderByUser']);
});

    Route::get('/{id_categoria}', [CategoriaController::class, 'show']);

    Route::post('/', [CategoriaController::class, 'store']);

    Route::put('/{id_categoria}', [CategoriaController::class, 'update']);

    Route::patch('/{id_categoria}', [CategoriaController::class, 'edit']);

Route::middleware('auth:api')->group(function () {
  Route::post('/logout', [AuthController::class, 'logout']);
  Route::get('/me', [AuthController::class, 'me']);
});

Route::post('/adminLogin', [AdminController::class,'login']);

Route::middleware('auth:admin')->group(function () {
  Route::get('/admin/me', [AdminController::class, 'me']);
  Route::post('/admin/logout', [AdminController::class, 'logout']); 
});