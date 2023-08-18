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
        Schema::create('impuestos_tipos_documentos_sectores', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_actividad');
            $table->integer('codigo_documento_sector');
            $table->string('tipo_documento_sector');
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
        Schema::dropIfExists('impuestos_tipos_documentos_sectores');
    }
};
