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
        Schema::create('cabecera_compras', function (Blueprint $table) {
            $table->id();
            $table->integer('tipo_documento_id');
            $table->integer('numero_documento');
            $table->unsignedBigInteger('proveedor_id');
            $table->date('fecha');
            $table->time('hora');
            $table->decimal('total', 10, 5);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('metodo_pago_id');
            $table->text('nota');
            $table->string('lote', 150);
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
        Schema::dropIfExists('cabecera_compras');
    }
};
