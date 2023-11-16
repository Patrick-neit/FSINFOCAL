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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_pago');
            $table->string('tipo_pago')->nullable();
            $table->string('banco')->nullable();
            $table->integer('nro_cuenta')->nullable();
            $table->integer('nro_comprobante')->nullable();
            $table->decimal('total', 18, 4)->nullable();
            $table->double('monto_pago');

            $table->unsignedBigInteger('alumno_id');
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
        Schema::dropIfExists('pagos');
    }
};
