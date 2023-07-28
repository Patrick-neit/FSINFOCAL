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
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->integer('ci');
            $table->string('lugar_nacimiento')->nullable();
            $table->date('fecha_nacimiento');
            $table->string('domicilio');
            $table->integer('celular');
            $table->char('sexo')->nullable();
            $table->string('email');
            $table->char('beca')->nullable(); /* Parcial||Total */
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
        Schema::dropIfExists('alumnos');
    }
};
