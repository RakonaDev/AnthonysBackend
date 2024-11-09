<?php

use App\Models\Pedidos;
use App\Models\Producto;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('detalle_pedido', function (Blueprint $table) {
      $table->id('id_detalle');
      $table->foreignIdFor(Pedidos::class, 'id_pedido');
      $table->foreignIdFor(Producto::class, 'id_producto');
      $table->integer('cantidad');
      $table->double('subtotal');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('detalle_pedido');
  }
};
