<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PedidosController extends Controller
{
  
  public function index() {
    $pedidos = Pedidos::all();

    if($pedidos->isEmpty()){
      $reponse = [
        'mensaje' => 'No hay pedidos',
        'pedidos' => $pedidos,
        'status' => 200,
      ];
      return response()->json($reponse, 200);
    }

    $reponse = [
      'pedidos' => $pedidos,
      'status' => 200,
    ];

    return response()->json($reponse, 200);
  }

  public function store (Request $request) {
    $validacion = Validator::make($request->all(), [
      'id_usuario' => 'required|numeric',
      'total' => 'required|numeric',
      'direccion' => 'required|string',
    ]);

    if($validacion->fails()){
      $reponse = [
        'error' => $validacion->errors(),
        'status' => 400
      ];
      return response()->json($reponse, 400);
    }
    
    $pedidoCreado = Pedidos::create([
      'id_usuario'=> $request->id_usuario,
      'total'=> $request->total,
      'direccion' => $request->direccion,
      'estado'=> 'Pendiente',
    ]);

    $reponse = [
      'mensaje' => 'Pedido Creado Correctamente',
      'pedido' => $pedidoCreado,
      'status' => 200
    ];

    return response()->json($reponse, 200);
  }

  public function show($id_pedido) {
    $pedidos = Pedidos::find($id_pedido);

    if($pedidos == null){
      $reponse = [
        'mensaje' => 'No se ha encontrado el pedido',
        'pedido' => $pedidos,
        'status' => 404
      ];

      return response()->json($reponse, 404);
    }

    $response = [
      'pedido' => $pedidos,
      'status'=> 200
    ];

    return response()->json($response, 200);
  }

  public function edit(Request $request , $id_pedido) {
    $pedido = Pedidos::find($id_pedido);
    if($pedido == null){
      $reponse = [
        'mensaje' => 'Pedido no encontrado',
        'status'=> 404
      ];
      return response()->json($reponse, 404);
    }

    $validado = Validator::make($request->all(), [
      'id_usuario' => 'numeric',
      'total' => 'numeric',
      'direccion' => 'string',
      'estado' => 'string'
    ]);

    if($validado->fails()) {
      $reponse = [
        'errors' => $validado->errors(),
        'status' => 400
      ];
      return response()->json($reponse, 400);
    }

    if($request->id_usuario != null){
      $pedido->id_usuario = $request->id_usuario;
    }

    if($request->total != null){
      $pedido->total = $request->total;
    }

    if($request->direccion != null){
      $pedido->direccion = $request->direccion;
    }

    if($request->estado != null){
      $pedido->estado = $request->estado;
    }
    
    if ($pedido->save()){
      $response = [
        'mensaje' => 'Pedido actualizado correctamente',
        'pedido' => $pedido,
        'status' => 202
      ];
      return response()->json($response, 202);      
    }
    
    $response = [
      'mensaje' => 'Hubo un error con la funcion',
      'status' => 417
    ];
    return response()->json($response, 417);
  }

  public function update (Request $request, $id_pedido) {
    $pedido = Pedidos::find($id_pedido);

    if($pedido == null){
      $response = [
        'mensaje' => 'Producto no encontrado',
        'status'=> 404
      ];

      return response()->json($response, 404);
    }

    $esValido = Validator::make($request->all(),[
      'id_usuario' => 'required|string',
      'total' => 'required|string',
      'direccion' => 'required|direccion',
      'estado' => 'required|string',
    ]);

    if($esValido->fails()){
      $response = [
        'mensaje' => 'No se pudo actualizar el pedido',
        'errors' => $esValido->errors(),
        'status' => 400
      ];
      return response()->json($response, 400);
    }

    $pedido->update( $request->all());

    $pedidoActualizado = [
      'id_usuario' => $pedido->id_usuario,
      'total' => $request->total,
      'direccion' => $request->direccion,
      'estado' => $request->estado
    ];

    $reponse = [
      'mensaje' => 'Pedido actualizado correctamente',
      'pedido' => $pedidoActualizado,
      'status'=> 200
    ];
    return response()->json($reponse, 200);
  }

  public function destroy ($id_pedido) {
    $pedido = Pedidos::find($id_pedido);

    if($pedido == null){
      $response = [
        'mensaje' => 'Pedido no encontrado.',
        'status' => 404
      ];
      return response()->json($response, 404);
    }
    else{
      $pedido->delete();

      $response = [
        'mensaje' => 'Pedido eliminado correctamente',
        'status'=> 200
      ];
      return response()->json($response, 200);
    }
  }

  public function getOrderByUser ($id_usuario) {
    $usuario = User::find($id_usuario);

    if($usuario == null){
      $reponse = [
        'mensaje' => 'Ese usuario no existe',
        'status' => 404
      ];

      return response()->json($reponse, 404);
    }

    $pedidos = Pedidos::with('users')->where('id_usuario', $id_usuario)->get();

    if($pedidos->isEmpty()){
      $reponse = [
        'mensaje' => 'No hay pedidos',
        'pedidos' => $pedidos,
        'status' => 200
      ];
      return response()->json($reponse, 200);
    }

    $reponse = [
      'pedidos' => $pedidos,
      'status' => 200
    ];
    return response()->json($reponse, 200);
  }
}
