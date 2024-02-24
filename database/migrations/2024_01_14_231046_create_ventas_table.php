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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_venta');
            $table->time('hora_venta');
            $table->integer('numero_factura');
            $table->decimal('total', 18, 4)->nullable();
            $table->decimal('descuento', 18, 4)->nullable();
            $table->decimal('monto_gifcard', 18, 4)->nullable();
            $table->decimal('total_venta', 18, 4)->nullable();
            $table->string('cuf_emision')->nullable();
            $table->char('estado_emision')->default('R');
            $table->boolean('estado_anulacion');
            $table->boolean('estado_reversion')->default(1);
            $table->unsignedBigInteger('cufd_id');
            $table->unsignedBigInteger('numero_tarjeta')->nullable();
            $table->unsignedBigInteger('tipo_pago_id');
            $table->unsignedBigInteger('moneda_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('codigo_punto_venta');
            $table->unsignedBigInteger('sucursal_id');
            $table->string('leyenda');
            $table->unsignedBigInteger('evento_significativo_id')->nullable();
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
        Schema::dropIfExists('ventas');
    }
};
