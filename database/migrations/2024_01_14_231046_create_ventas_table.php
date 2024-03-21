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
            $table->string('nit_emisor');
            $table->string('razon_social_emisor');
            $table->string('municipio');
            $table->time('hora_venta');
            $table->integer('numero_factura');
            $table->string('cuf_emision')->nullable();
            $table->string('cufd');
            $table->text('direccion');
            $table->date('fecha_venta');
            $table->integer('codigo_metodo_pago');
            $table->decimal('total_venta', 18, 5)->nullable();
            $table->decimal('monto_total_sujeto_iva', 18, 5)->nullable();
            $table->decimal('descuento', 18, 5)->nullable();
            $table->decimal('total', 18, 5)->nullable();
            $table->decimal('monto_gifcard', 18, 5)->nullable();
            $table->decimal('tipo_cambio', 18, 5);
            $table->decimal('debito_fiscal', 18, 5);
            $table->char('estado_emision')->default('R');
            $table->char('estado_documento');
            $table->string('codigo_estado');
            $table->string('codigo_descripcion');
            $table->string('codigo_control');
            $table->boolean('estado_anulacion');
            $table->unsignedBigInteger('codigo_doc_sector');
            $table->text('codigo_qr');
            $table->boolean('estado_reversion')->default(1);
            $table->unsignedBigInteger('numero_tarjeta')->nullable();
            $table->unsignedBigInteger('codigo_moneda');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('codigo_punto_venta');
            $table->unsignedBigInteger('sucursal_id');
            $table->integer('cantidad_habitaciones');
            $table->integer('cantidad_huespedes');
            $table->integer('cantidad_mayores');
            $table->integer('cantidad_menores');
            $table->integer('anulacion_user');
            $table->integer('reversion_user');
            $table->dateTime('fecha_anulacion');
            $table->dateTime('fecha_reversion');
            $table->string('periodo_facturado')->nullable();
            $table->string('nombre_estudiante')->nullable();
            $table->string('leyenda');
            $table->unsignedBigInteger('codigo_exepcion')->nullable();
            $table->unsignedBigInteger('codigo_evento')->nullable();
            $table->string('cafc')->nullable();
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
        Schema::dropIfExists('ventas');
    }
};
