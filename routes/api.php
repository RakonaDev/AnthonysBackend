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

Route::get('/productos/{id}', function () { 
  return 'Mostrando Producto por id';
});

Route::put('/productos', function () {
  return 'Creando Nuevo Producto';
});

Route::patch('/productos/{id}', function () {
  return 'Modificando Producto por id';
});


Route::delete('/productos/{id}', function () {
  return 'Eliminando Producto por id';
});
