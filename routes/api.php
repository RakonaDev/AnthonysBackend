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
use App\Http\Controllers\CategoriaController;

//================================ PRODUCTOS =============================================

Route::get('/productos', [ProductoController::class, 'index']);

Route::get('/productos/{id_producto}', [ProductoController::class,'show']);

Route::post('/productos', [ProductoController::class, 'store']);

Route::put('/productos/{id_producto}', [ProductoController::class,'update']);

Route::patch('/productos/{id_producto}', [ProductoController::class,'edit']);

Route::delete('/productos/{id_producto}', [ProductoController::class, 'destroy']);



Route::prefix('categorias')->group(function () {

    Route::get('/', [CategoriaController::class, 'index']);

    Route::get('/{id_categoria}', [CategoriaController::class, 'show']);

    Route::post('/', [CategoriaController::class, 'store']);

    Route::put('/{id_categoria}', [CategoriaController::class, 'update']);

    Route::patch('/{id_categoria}', [CategoriaController::class, 'edit']);

    Route::delete('/{id_categoria}', [CategoriaController::class, 'destroy']);
});