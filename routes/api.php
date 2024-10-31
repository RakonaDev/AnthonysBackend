<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PedidosController;
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

use App\Http\Controllers\ProductoController;

//================================ PRODUCTOS =============================================

Route::get('/productos', [ProductoController::class, 'index']);

Route::get('/productos/{id_producto}', [ProductoController::class,'show']);

Route::post('/productos', [ProductoController::class, 'store']);

Route::put('/productos/{id_producto}', [ProductoController::class,'update']);

Route::patch('/productos/{id_producto}', [ProductoController::class,'edit']);

Route::delete('/productos/{id_producto}',[ProductoController::class,'destroy']);

//=========================================================================================

//================================= PEDIDOS ===============================================

Route::get('/pedidos', [PedidosController::class, 'index']);

Route::middleware('auth:api')->group(function () {
  Route::get('/pedidos/usuario/{id_usuario}', [PedidosController::class, 'getOrderByUser']);
});

//=========================================================================================

//================================= AUTHENTICATION ========================================

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
  Route::post('/logout', [AuthController::class, 'logout']);
  Route::get('/me', [AuthController::class, 'me']);
});