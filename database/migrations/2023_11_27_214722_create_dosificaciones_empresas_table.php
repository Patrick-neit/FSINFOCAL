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
        Schema::create('dosificaciones_empresas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_asignacion');
            $table->string('cafc')->nullable();
            $table->integer('inicio_nro_factura')->nullable();
            $table->integer('fin_nro_factura')->nullable();
            $table->unsignedBigInteger('empresa_id');
            $table->boolean('estado');
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
        Schema::dropIfExists('dosificaciones_empresas');
    }
};
