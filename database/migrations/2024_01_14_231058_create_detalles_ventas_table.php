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
        Schema::create('detalles_ventas', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->decimal('cantidad', 18, 4);
            $table->decimal('precio', 18, 4);
            $table->decimal('descuento_item', 18, 4);
            $table->decimal('subtotal', 18, 4);

            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('venta_id');

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
        Schema::dropIfExists('detalles_ventas');
    }
};
