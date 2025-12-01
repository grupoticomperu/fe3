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
        Schema::create('transportistas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipodocumento_id')->nullable();// ruc, dni, carnet de extranjeria
            $table->foreign('tipodocumento_id')->references('id')->on('tipodocumentos')->onDelete('cascade');

            $table->string('numdoc')->unique(); //solo aceptara RUCS si pones DNI da error al generar la guia
            $table->string('nomrazonsocial')->unique();
            $table->string('address')->nullable();
            $table->string('nromtc')->nullable();

            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->boolean('predeterminado')->default(0);
            $table->boolean('state')->default(1);

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
        Schema::dropIfExists('transportistas');
    }
};
