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
        Schema::create('impuestos_productos_servicios', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_actividad');
            $table->integer('codigo_producto');
            $table->string('descripcion_producto');
            $table->string('transaccion');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('impuestos_productos_servicios');
    }
};
