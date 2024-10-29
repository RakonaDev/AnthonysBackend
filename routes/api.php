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

use App\Http\Controllers\ProductoController;

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::get('/productos', [ProductoController::class, 'index']);

Route::get('/productos/{id_producto}', [ProductoController::class,'show']);

Route::post('/productos', [ProductoController::class, 'store']);

Route::put('/productos/{id_producto}', [ProductoController::class,'update']);

Route::patch('/productos/{id_producto}', [ProductoController::class,'edit']);


Route::delete('/productos/{id}', function () {
  return 'Eliminando Producto por id';
});

