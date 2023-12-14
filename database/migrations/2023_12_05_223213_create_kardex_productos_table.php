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
        Schema::create('kardex_productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id');
            $table->date('fecha');
            $table->time('hora');
            $table->string('doc_soporte', 20);
            $table->string('tipo_movimiento', 50);
            $table->decimal('cantidad_ingresos', 10, 5);
            $table->decimal('precio_unitario_ingresos', 10, 5);
            $table->decimal('total_ingresos', 10, 5);
            $table->decimal('cantidad_egresos', 10, 5);
            $table->decimal('precio_unitario_egresos', 10, 5);
            $table->decimal('total_egresos', 10, 5);
            $table->decimal('cantidad_saldo_actual', 10, 5);
            $table->decimal('promedio', 10, 5);
            $table->decimal('costo_total_saldo', 10, 5);
            $table->decimal('utilidad', 10, 5);
            $table->unsignedBigInteger('usuario_id');
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
        Schema::dropIfExists('kardex_productos');
    }
};
