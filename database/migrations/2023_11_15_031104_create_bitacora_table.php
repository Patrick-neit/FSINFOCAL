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
        Schema::create('bitacora', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('ip');
            $table->morphs('binnacleable');
            $table->string('action');
            $table->timestamp('created_model_at')->useCurrent();
            $table->timestamp('updated_model_at')->nullable();
            $table->timestamp('deleted_model_at')->nullable();
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
        Schema::dropIfExists('bitacora');
    }
};
