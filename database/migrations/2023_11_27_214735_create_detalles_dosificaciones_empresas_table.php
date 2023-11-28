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
        Schema::create('detalles_dosificaciones_empresas', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion_documento_sector');
            $table->string('codigo_actividad_documento_sector');
            $table->unsignedBigInteger('tipo_factura_documento_sector');
            $table->unsignedBigInteger('documento_sector_id');
            $table->unsignedBigInteger('dosificacion_empresa_id');
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
        Schema::dropIfExists('detalles_dosificaciones_empresas');
    }
};
