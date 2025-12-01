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
        Schema::create('comprobante_producto', function (Blueprint $table) {
            $table->id();

            $table->double('cant', 10, 4)->nullable();
            $table->double('price', 10, 4)->nullable();//precio venta
            //$table->double('mtovalorunitario', 10, 4)->nullable();
            $table->double('subtotal', 10, 4)->nullable();

            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->unsignedBigInteger('comprobante_id')->nullable();
            $table->foreign('comprobante_id')->references('id')->on('comprobantes')->onDelete('cascade');

            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

            $table->string('codigobarras')->nullable();
            $table->double('mtobaseigv', 10, 4)->nullable(); // cantidad * precio sin igv
            $table->double('igv', 10, 4)->nullable();//ejemlo 18 soles, 36 soles
            $table->double('icbper', 10, 4)->nullable();//ejemlo 0.8 soles   0.2x 4
            $table->double('totalimpuestos', 10, 4)->nullable();
            $table->double('mtovalorventa', 10, 4)->nullable();


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
        Schema::dropIfExists('comprobante_producto');
    }
};
