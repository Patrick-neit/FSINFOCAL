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
        Schema::create('puntos_ventas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_punto_venta');
            $table->integer('tipo_punto_venta');
            $table->integer('codigo_punto_venta');
            $table->string('descripcion_punto_venta')->nullable();
            $table->unsignedBigInteger('sucursal_id');
            $table->unsignedBigInteger('empresa_id');
            $table->softDeletes();
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
        Schema::dropIfExists('puntos_ventas');
    }
};
