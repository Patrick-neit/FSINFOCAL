<?php

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
        Schema::create('detalle_productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id');
            $table->decimal('precio_compra', 10, 5);
            $table->decimal('precio_unitario', 10, 5);
            $table->decimal('precio_unitario2', 10, 5);
            $table->decimal('precio_unitario3', 10, 5);
            $table->decimal('precio_unitario4', 10, 5);
            $table->decimal('precio_paquete', 10, 5);
            $table->decimal('precio_venta_dolar', 10, 5);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_productos');
    }
};
