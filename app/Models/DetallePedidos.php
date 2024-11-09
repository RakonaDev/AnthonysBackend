<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedidos extends Model
{
  use HasFactory;

  protected $table = 'detalle_pedido';

  protected $fillable = [
    'id_pedido',
    'id_producto',
    'cantidad',
    'subtotal'
  ];

  protected $guarded = [

  ]; 
}
