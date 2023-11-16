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
        Schema::create('configuraciones_impuestos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_sistema');
            $table->boolean('ambiente')->comment('1:Produccion|2:Pruebas');
            $table->boolean('modalidad')->comment('1:Linea|2:OffLinea');
            $table->text('codigo_sistema');
            $table->text('token_sistema');
            $table->unsignedBigInteger('empresa_id');
            $table->boolean('estado')->default(1);
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
        Schema::dropIfExists('configuraciones_impuestos');
    }
};
