<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
  use HasFactory;

  protected $table = 'pedidos';

  protected $primaryKey = 'id_pedido';

  protected $fillable = [
    'id_usuario',
    'total',
    'direccion',
    'estado'
  ];

  protected $guarded = [

  ];

  public function detalle(){
    return $this->hasMany(DetallePedidos::class, 'id_pedido');
  }

  
  public function productos() {
    return $this->belongsTo(Producto::class);
  }
}
