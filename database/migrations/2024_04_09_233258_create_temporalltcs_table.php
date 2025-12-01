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
        Schema::create('temporalltcs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')->constrained();
            //$table->foreignId('local_id')->constrained();//lo comente porque no sabemos a que local ira el temporal
            $table->foreignId('tipocomprobante_id')->constrained();
            $table->string('serie');
            $table->integer('inicia');
            //$table->foreignId('employee_id')->constrained();//para identificarla venta del usuario o empleado

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
        Schema::dropIfExists('temporalltcs');
    }
};
