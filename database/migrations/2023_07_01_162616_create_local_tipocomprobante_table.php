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
        Schema::create('local_tipocomprobante', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('local_id')->nullable();
            $table->foreign('local_id')->references('id')->on('locals')->onDelete('cascade');

            $table->unsignedBigInteger('tipocomprobante_id')->nullable();
            $table->foreign('tipocomprobante_id')->references('id')->on('tipocomprobantes')->onDelete('cascade');

            $table->string('serie');
            $table->integer('inicia');
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
        Schema::dropIfExists('local_tipocomprobante');
    }
};
