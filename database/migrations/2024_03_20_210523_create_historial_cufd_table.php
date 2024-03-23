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
        Schema::create('historial_cufd', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_cufd');
            $table->dateTime('f_inicio');
            $table->dateTime('f_vigencia');
            $table->string('transaccion', 10);
            $table->string('codigo_control', 50);
            $table->string('cuis', 20);
            $table->text('direccion');

            $table->unsignedBigInteger('sucursal_id');
            $table->unsignedBigInteger('empresa_id');
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
        Schema::dropIfExists('historial_cufd');
    }
};
