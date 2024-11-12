<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedidos extends Model
{
  use HasFactory;

  protected $table = 'detalle_pedido';

  protected $primaryKey = 'id_detalle';

  protected $fillable = [
    'id_pedido',
    'id_producto',
    'cantidad',
    'subtotal'
  ];

  protected $guarded = [

  ]; 
  
  public function pedido(){
    return $this->belongsTo(Pedidos::class, 'id_pedido');
  }

  public function producto() {
    return $this->belongsTo(Producto::class,'id_producto');
  }

}
