<?php

use App\Models\Producto;
use App\Models\User;
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
    Schema::create('pedidos', function (Blueprint $table) {
      $table->id('id_pedido');
      $table->foreignId('id_usuario')->constrained('users', 'id_usuario')->onDelete('cascade');
      $table->double('total');
      $table->string('direccion');
      $table->string('estado');
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
    Schema::dropIfExists('pedidos');
  }
};
