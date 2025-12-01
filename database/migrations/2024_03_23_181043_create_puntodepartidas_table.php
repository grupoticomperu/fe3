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
        Schema::create('puntodepartidas', function (Blueprint $table) {
            $table->id();
            $table->string('direccion');
            $table->string('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->string('province_id')->nullable();
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->string('district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts');
            $table->string('ubigeo');
            $table->boolean('predeterminado')->default(0);
            $table->boolean('state')->default(1);
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
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
        Schema::dropIfExists('puntodepartidas');
    }
};
