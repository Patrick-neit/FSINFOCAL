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
        Schema::create('catalogos_precios_productos', function (Blueprint $table) {
            $table->id();
            $table->integer('tipo_precio_a');
            $table->integer('tipo_precio_b');
            $table->integer('tipo_precio_c');
            $table->integer('tipo_precio_d');
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('cliente_id');
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
        Schema::dropIfExists('catalogos_precios_productos');
    }
};
