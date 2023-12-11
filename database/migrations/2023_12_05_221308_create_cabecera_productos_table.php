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
        Schema::create('cabecera_productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('codigo_actividad'); //tabla dosificaciones
            $table->unsignedBigInteger('codigo_producto_sin'); //Otros productos alcanzados por el Iva

            $table->unsignedBigInteger('unidad_medida_id'); //tabla impuestos unidad medida
            $table->unsignedBigInteger('marca_id');
            $table->unsignedBigInteger('categoria_id');
            $table->integer('tipo_id'); //1 Producto 2 Servicio
            $table->unsignedBigInteger('sub_familia_id');
            $table->string('codigo_producto', 50);
            $table->string('nombre_producto', 450);
            $table->unsignedBigInteger('codigo_producto_impuestos');
            $table->string('modelo', 450);
            $table->string('numero_serie', 150)->nullable();
            $table->string('numero_imei', 150)->nullable();
            $table->integer('peso_unitario')->nullable();
            $table->string('codigo_barra', 450)->nullable();
            $table->string('caracteristicas', 450)->nullable();
            $table->decimal('stock_minimo', 10, 5);
            $table->boolean('estado')->default(1);
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
        Schema::dropIfExists('cabecera_productos');
    }
};
