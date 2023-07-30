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
        Schema::create('puntos_ventas_cufds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cuis_id');
            $table->unsignedBigInteger('cufd_id');
            $table->unsignedBigInteger('punto_venta_id');
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
        Schema::dropIfExists('puntos_ventas_cufds');
    }
};
