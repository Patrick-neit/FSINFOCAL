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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_proveedor', 450);
            $table->string('direccion', 450);
            $table->string('telefono', 50);
            $table->string('rubro', 150);
            $table->string('numero_nit', 20);
            $table->string('correo', 450);
            $table->string('contacto', 450);
            $table->integer('tipo_documento');
            $table->integer('sucursal_id');
            $table->boolean('estado');
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
        Schema::dropIfExists('proveedores');
    }
};
