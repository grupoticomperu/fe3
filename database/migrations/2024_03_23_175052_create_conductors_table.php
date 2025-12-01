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
        Schema::create('conductors', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('tipodocumento_id')->nullable();// ruc, dni, carnet de extranjeria
            $table->foreign('tipodocumento_id')->references('id')->on('tipodocumentos')->onDelete('cascade');
            $table->string('numdoc')->unique();
            $table->string('nomape');
            $table->string('licencia');
            $table->string('celular');
            $table->boolean('state')->default(1);

            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('conductors');
    }
};
