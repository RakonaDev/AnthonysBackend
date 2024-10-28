<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProductoFormRequest;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
  public function index(Request $request){ 
    
    if($request){
      $query = trim($request->get('searchText'));
      $productos = DB::table('producto')->where('nombre', 'LIKE', '%'.$query.'%');
      return view('almacen.producto.index', ['id_producto' => $productos, "searchText" => $query]);
    }
      
  }

  public function create() {
    return view("almacen.producto.create");
  }

  public function store (ProductoFormRequest $request) {
    $producto = new Producto;
    $producto->nombre = $request->get("nombre");
    $producto->precio = $request->get("precio");
    $producto->id_categoria = $request->get("id_categoria");
    $producto->description = $request->get("description");
    $producto->save();
    return Redirect::to('productos');
  }

  public function show($id) {
    return view("almacen.producto.show", ["producto" => Producto::findOrFail($id)]);
  }

  public function edit($id) {
    return view("almacen.producto.edit", ["producto" => Producto::findOrFail($id)]);
  }

  public function update (ProductoFormRequest $request, $id) {
    $producto = Producto::findOrFail($id);
    $producto->nombre = $request->get("nombre");
    $producto->precio = $request->get("precio");
    $producto->id_categoria = $request->get("id_categoria");
    $producto->description = $request->get("description");
    $producto->update();

    return Redirect::to("/productos");
  }

  public function destroy ($id) {
    $producto = Producto::findOrFail($id);
    $producto->id_categoria = '0';
    $producto->update();

    return Redirect::to("/productos");
  }
}
