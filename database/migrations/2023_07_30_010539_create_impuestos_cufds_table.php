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
        Schema::create('impuestos_cufds', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_generado');
            $table->dateTime('fecha_vencimiento');
            $table->string('codigo_cufd');
            $table->string('codigo_control');
            $table->string('direccion');
            $table->char('estado');

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
        Schema::dropIfExists('impuestos_cufds');
    }
};
