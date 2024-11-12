<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
   // Muestra todas las categorías
  public function index() {
    $categorias = Categoria::all();

    if ($categorias->isEmpty()) {
      $response = [
        "mensaje" => "No se han encontrado categorías",
        "status" => 200
      ];
      return response()->json($response, 200);
    }

    $response = [
      "categorias" => $categorias,
      "status" => 200
    ];
    return response()->json($response, 200);
  }

  // Guarda la categoría en la base de datos
  public function store(Request $request) {
    $validacion = Validator::make($request->all(), [
      'nombre' => 'required|string|unique:categoria,nombre',
    ]);

    if ($validacion->fails()) {
      $response = [
        'error' => $validacion->errors(),
        'status' => 400
      ];
      return response()->json($response, 400);
    }

    $categoriaCreada = Categoria::create([
      'nombre' => strtolower($request->nombre),
    ]);

    $response = [
      'mensaje' => 'Categoría Creada Correctamente',
      'categoria' => $categoriaCreada,
      'status' => 200
    ];
    return response()->json($response, 200);
  }

  // Busca categoría por ID
  public function show($id_categoria) {
    $categoria = Categoria::find($id_categoria);

    if ($categoria == null) {
      $response = [
        'mensaje' => 'No se ha encontrado la categoría',
        'status' => 404
      ];
      return response()->json($response, 404);
    }

    $response = [
      'categoria' => $categoria,
      'status' => 200
    ];
    return response()->json($response, 200);
  }

  // Editar uno o más parámetros de la categoría seleccionada
  public function edit(Request $request, $id_categoria) {
    $categoria = Categoria::find($id_categoria);
    if ($categoria == null) {
      $response = [
        'mensaje' => 'Categoría no encontrada',
        'status' => 404
      ];
      return response()->json($response, 404);
    }

    $validado = Validator::make($request->all(), [
      'nombre' => 'string|unique:categoria,nombre',
    ]);

    if ($validado->fails()) {
      $response = [
        'errors' => $validado->errors(),
        'status' => 400
      ];
      return response()->json($response, 400);
    }

    if ($request->nombre != null) {
      $categoria->nombre = $request->nombre;
    }

    if ($categoria->save()) {
      $response = [
        'mensaje' => 'Categoría actualizada correctamente',
        'categoria' => $categoria,
        'status' => 200
      ];
      return response()->json($response, 200);
    }

    $response = [
      'mensaje' => 'Hubo un error con la función',
      'status' => 501
    ];
    return response()->json($response, 501);
  }

  // Editar por completo la categoría seleccionada
  public function update(Request $request, $id_categoria) {
    $categoria = Categoria::find($id_categoria);

    if ($categoria == null) {
      $response = [
        'mensaje' => 'Categoría no encontrada',
        'status' => 404
      ];
      return response()->json($response, 404);
    }

    $esValido = Validator::make($request->all(), [
      'nombre' => 'required|string|unique:categoria,nombre',
    ]);

    if ($esValido->fails()) {
      $response = [
        'mensaje' => 'No se pudo actualizar la categoría',
        'errors' => $esValido->errors(),
        'status' => 400
      ];
      return response()->json($response, 400);
    }

    $categoria->update($request->all());

    $categoriaActualizada = [
      'id_categoria' => $categoria->id_categoria,
      'nombre' => $request->nombre,
    ];

    $response = [
      'mensaje' => 'Categoría actualizada correctamente',
      'categoria' => $categoriaActualizada,
      'status' => 200
    ];
    return response()->json($response, 200);
  }

  // Eliminar categoría de la base de datos
  public function destroy($id_categoria) {
    $categoria = Categoria::find($id_categoria);
    if ($categoria == null) {
      $response = [
        'mensaje' => 'Categoría no encontrada.',
        'status' => 404
      ];
      return response()->json($response, 404);
    } else {
      $categoria->delete();

      $response = [
        'mensaje' => 'Categoría eliminada correctamente',
        'status' => 200
      ];
      return response()->json($response, 200);
    }
  }

}
