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
        Schema::create('temporalgrs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')->constrained();
            //$table->foreignId('product_id')->constrained();
            $table->string('codigobarras');
            $table->foreignId('employee_id')->constrained();//para identificarla venta del usuario o empleado
            $table->string('image')->nullable();
            $table->string('name');
            $table->string('um');
            $table->integer('quantity');

            $table->unsignedBigInteger('product_id')->nullable;
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');


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
        Schema::dropIfExists('temporalgrs');
    }
};
