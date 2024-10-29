<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
  // Muestra todos los productos
  public function index(){ 
    
    $productos = Producto::all();

    if($productos->isEmpty()){
      $reponse = [
        "mensaje" => "No se han encontrado productos",
        "productos" => $productos,
        "status" => 200
      ];
      return response()->json($reponse, 200);
    }

    $response = [
      "productos" => $productos,
      "status" => 200
    ];
    return response()->json($response , 200);
  }

  // Guarda el producto a la base de datos
  public function store (Request $request) {
    $validacion = Validator::make($request->all(), [
      'nombre' => 'required|string|unique:producto,nombre',
      'precio' => 'required|numeric',
      'descripción' => 'required|string',
      'id_categoria' => 'required|numeric',
      'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048'
    ]);

    if($validacion->fails()){
      $reponse = [
        'error' => $validacion->errors(),
        'status' => 400
      ];
      return response()->json($reponse, 400);
    }
    
    $productoCreado = Producto::create([
      'nombre'=> strtolower($request->nombre),
      'descripción'=> $request->descripción,
      'precio' => $request->precio,
      'url_imagen'=> '',
      'id_categoria'=> $request->id_categoria,
    ]);

    // Crear la imagen del producto
    $image = $request->file('imagen');
    $imageName = $productoCreado->id_producto . '.' . $image->getClientOriginalExtension();
    $imagePath = $image->storeAs('img/productos', $imageName, 'public');

    $productoCreado->update([
      'url_imagen' => $imagePath
    ]);

    $productoCreado->url_imagen = $imagePath;

    $reponse = [
      'mensaje' => 'Producto Creado Correctamente',
      'producto' => $productoCreado,
      'status'=> 200
    ];
    return response()->json($reponse, 200);
  }

  // Busca producto por ID
  public function show($id_producto) {
    $producto = Producto::find($id_producto);

    if($producto == null){
      $reponse = [
        'mensaje' => 'No se ha encontrado el producto',
        'producto' => $producto,
        'status' => 404
      ];

      return response()->json($reponse, 404);
    }

    $response = [
      'producto' => $producto,
      'status'=> 200
    ];

    return response()->json($response, 200);
  }

  // Editar uno o más parametros del producto seleccionado
  public function edit(Request $request , $id_producto) {
    $producto = Producto::find($id_producto);
    if($producto == null){
      $reponse = [
        'mensaje' => 'Producto no encontrado',
        'status'=> 404
      ];
      return response()->json($reponse, 404);
    }

    $validado = Validator::make($request->all(), [
      'nombre' => 'string',
      'descripción' => 'string',
      'precio' => 'numeric',
      'url_imagen' => 'string',
      'id_categoria' => 'numeric'
    ]);

    if($validado->fails()) {
      $reponse = [
        'errors' => $validado->errors(),
        'status' => 400
      ];
      return response()->json($reponse, 400);
    }

    if($request->nombre != null){
      $producto->nombre = $request->nombre;
    }

    if($request->precio != null){
      $producto->precio = $request->precio;
    }

    if($request->descripción != null){
      $producto->descripción = $request->descripción;
    }

    if($request->url_imagen != null){
      $producto->url_imagen = $request->url_imagen;
    }

    if($request->id_categoria != null){
      $producto->id_categoria = $request->id_categoria;
    }
    
    if ($producto->save()){
      $response = [
        'mensaje' => 'Producto actualizado correctamente',
        'producto' => $producto,
        'status' => 200
      ];
      return response()->json($response, 200);      
    }
    
    $response = [
      'mensaje' => 'Hubo un error con la funcion',
      'status' => 501
    ];
    return response()->json($response, 501);
  }

  // Editar por completo el producto seleccionado
  public function update (Request $request, $id_producto) {
    $producto = Producto::find($id_producto);

    if($producto == null){
      $response = [
        'mensaje' => 'Producto no encontrado',
        'status'=> 404
      ];

      return response()->json($response, 404);
    }

    $esValido = Validator::make($request->all(),[
      'nombre' => 'required|string|unique:producto,nombre',
      'descripción' => 'required|string|unique:producto,descripción',
      'precio' => 'required|numeric',
      'id_categoria' => 'required|numeric',
      'url_imagen' => 'required|string|unique:producto,url_imagen'
    ]);

    if($esValido->fails()){
      $response = [
        'mensaje' => 'No se pudo actualizar el producto',
        'errors' => $esValido->errors(),
        'status' => 400
      ];
      return response()->json($response, 400);
    }

    $producto->update( $request->all());

    $productoActualizado = [
      'id_producto' => $producto->id_producto,
      'nombre' => $request->nombre,
      'descripcion' => $request->descripción,
      'precio' => $request->precio,
      'url_imagen' => $request->url_imagen,
      'id_categoria' => $request->id_categoria
    ];

    $reponse = [
      'mensaje' => 'Producto actualizado correctamente',
      'producto' => $productoActualizado,
      'status'=> 200
    ];
    return response()->json($reponse, 200);
  }

  // Eliminar producto de la base de datos
  public function destroy ($id_producto) {
    $producto = Producto::find($id_producto);
    if($producto == null){
      $response = [
        'mensaje' => 'Producto no encontrado.',
        'status' => 404
      ];
      return response()->json($response, 404);
    }
    else{
      $producto->delete();

      $response = [
        'mensaje' => 'Producto eliminado correctamente',
        'status'=> 200
      ];
      return response()->json($response, 200);
    }
  }
}
