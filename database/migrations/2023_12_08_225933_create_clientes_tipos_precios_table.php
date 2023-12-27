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
        Schema::create('clientes_tipos_precios', function (Blueprint $table) {
            $table->id();
            $table->integer('tipo_precio_a');
            $table->integer('tipo_precio_b');
            $table->integer('tipo_precio_c');
            $table->integer('tipo_precio_d');
            $table->integer('tipo_precio_e');
            $table->integer('tipo_precio_f');
            $table->integer('tipo_precio_g');
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
        Schema::dropIfExists('clientes_tipos_precios');
    }
};
