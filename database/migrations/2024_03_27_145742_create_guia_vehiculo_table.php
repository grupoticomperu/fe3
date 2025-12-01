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
        Schema::create('guia_vehiculo', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('guia_id');
            $table->foreign('guia_id')->references('id')->on('guias')->onDelete('cascade');
            $table->unsignedBigInteger('vehiculo_id');
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos')->onDelete('cascade');

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
        Schema::dropIfExists('guia_vehiculo');
    }
};
