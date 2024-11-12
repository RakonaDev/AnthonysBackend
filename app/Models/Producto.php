<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
  use HasFactory;
  protected $table = 'producto';

  protected $primaryKey = 'id_producto';

  protected $fillable = [
    'nombre',
    'descripción',
    'precio',
    'url_imagen',
    'id_categoria'
  ];
  protected $guarded = [
    
  ];

  public function detallesPedidos() {
    return $this->hasMany(DetallePedidos::class, 'id_detalle');
  }

}
