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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_cliente', 45);
            $table->integer('tipo_documento_id');
            $table->string('numero_nit', 20);
            $table->string('complemento', 5)->nullable();
            $table->string('direccion', 450)->nullable();
            $table->string('telefono', 50)->nullable();
            $table->integer('tipo_precio')->default(1);
            $table->string('correo');
            $table->integer('departamento_id');
            $table->dateTime('fecha_cumpleanos');
            $table->string('contacto', 450);
            $table->boolean('estado')->default('1');
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
        Schema::dropIfExists('clientes');
    }
};
