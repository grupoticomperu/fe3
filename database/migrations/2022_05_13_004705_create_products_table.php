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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('codigo')->nullable();
            $table->string('codigobarras')->unique();
            $table->string('name')->nullable();
            $table->text('description')->nullable();


            //$table->double('purchaseprice', 10, 4)->nullable(); //precio-compra con igv
            //$table->double('saleprice', 10, 4)->nullable(); //precio venta con igv
            //$table->double('salepricemin', 10, 4)->nullable(); //precio venta minimo con igv

            $table->decimal('purchaseprice', 10, 4)->nullable(); // precio compra con IGV
            $table->decimal('saleprice', 10, 4)->nullable();     // precio venta con IGV
            $table->decimal('salepricemin', 10, 4)->nullable();  // precio mínimo con IGV

            //$table->double('mtovalorgratuito', 10, 4)->default(0.00)->nullable();
            //$table->double('mtovalorunitario', 10, 4)->nullable(); //precio sin igv


            
            $table->decimal('mtovalorgratuito', 10, 4)->default(0.00)->nullable();
            $table->decimal('mtovalorunitario', 10, 4)->nullable(); //precio sin igv


            //$table->double('mtopreciounitario', 10, 4)->nullable();//precio con igv  es el saleprice por eso lo comento

            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('set null');

            $table->unsignedBigInteger('um_id')->nullable();
            $table->foreign('um_id')->references('id')->on('ums')->onDelete('set null');

            $table->unsignedBigInteger('modelo_id')->nullable();
            $table->foreign('modelo_id')->references('id')->on('modelos')->onDelete('set null'); //al eliminar un modelo no eliminara el producto

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');

            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');

            $table->unsignedBigInteger('tipoafectacion_id')->nullable();
            $table->foreign('tipoafectacion_id')->references('id')->on('tipoafectacions')->onDelete('set null');

            $table->boolean('esbolsa')->default(0);
            $table->boolean('detraccion')->nullable();
            $table->boolean('percepcion')->nullable();

            $table->boolean('state')->nullable();

            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();





            // $table->string('image');
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
        Schema::dropIfExists('products');
    }
};
