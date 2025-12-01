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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('local_tipocomprobante_id')->nullable();
            $table->foreign('local_tipocomprobante_id')->references('id')->on('local_tipocomprobante')->onDelete('cascade');

            $table->unsignedBigInteger('local_id')->nullable();
            $table->foreign('local_id')->references('id')->on('locals')->onDelete('cascade');

            $table->unsignedBigInteger('tipocomprobante_id')->nullable();
            $table->foreign('tipocomprobante_id')->references('id')->on('tipocomprobantes')->onDelete('cascade');

            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

            $table->unsignedBigInteger('paymenttype_id')->nullable();
            $table->foreign('paymenttype_id')->references('id')->on('paymenttypes')->onDelete('cascade');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');

            $table->string('serie');
            $table->integer('numero');

            $table->date('fechaemision')->nullable();
            $table->date('fechavencimiento')->nullable();

            $table->double('subtotal', 8, 2)->nullable();//precio venta
            $table->double('igv', 8, 2)->nullable();//precio venta
            $table->double('total', 8, 2)->nullable();//precio venta

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
        Schema::dropIfExists('sales');
    }
};
