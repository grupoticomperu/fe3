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
        Schema::create('comprobantes', function (Blueprint $table) {
            $table->id();


            //$table->double('total', 8, 2)->nullable();//precio venta
            //$table->string('formadepago')->nullable();
            //$table->string('numeroguia')->nullable();
            //relacion de uno a muchos polimorfica con factura boleta guia
            //$table->unsignedBigInteger('comprobanteable_id');
            //$table->string('comprobanteable_type');
            //relacion de uno a uno polimorfica con factura boleta guia
            //$table->unsignedBigInteger('comprobanteable_id');
            //$table->string('comprobanteable_type');
            //$table->primary(['comprobanteable_id', 'comprobanteable_type']);//no debe repetirse

            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

            $table->unsignedBigInteger('local_id')->nullable();
            $table->foreign('local_id')->references('id')->on('locals')->onDelete('cascade');

            $table->unsignedBigInteger('tipocomprobante_id')->nullable(); //$tipocomprobante_id = ""   01 es factura  tabla tipocomprobantes//seguarda en la tabla comprobantes
            $table->foreign('tipocomprobante_id')->references('id')->on('tipocomprobantes')->onDelete('cascade');

            $table->unsignedBigInteger('local_tipocomprobante_id')->nullable();
            $table->foreign('local_tipocomprobante_id')->references('id')->on('local_tipocomprobantes')->onDelete('cascade');

            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');


            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');

            $table->unsignedBigInteger('tipodeoperacion_id')->nullable(); //Catálogo No. 51: Código de tipo de operación 0101 venta interna tabla tipodeoperacions
            $table->foreign('tipodeoperacion_id')->references('id')->on('tipodeoperacions')->onDelete('cascade');


            $table->unsignedBigInteger('tipodocumento_id')->nullable(); // ruc, dni, carnet de extranjeria
            $table->foreign('tipodocumento_id')->references('id')->on('tipodocumentos')->onDelete('cascade');

            //$table->unsignedBigInteger('currency_id')->nullable();
            //$table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');

            //$table->string('serie');//estaran en la tabla boletas, facturas
            //$table->integer('numero');//correlativo
            $table->string('serienumero');

            $table->timestamp('fechaemision')->nullable();
            $table->timestamp('fechavencimiento')->nullable();

            $table->unsignedBigInteger('paymenttype_id')->nullable();
            $table->foreign('paymenttype_id')->references('id')->on('paymenttypes')->onDelete('cascade');

            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');


            /* $table->double('mtoopergravadas', 10, 4)->nullable(); 
            $table->double('mtooperexoneradas', 10, 4)->nullable(); 
            $table->double('mtooperinafectas', 10, 4)->nullable(); 
            $table->double('mtooperexportacion', 10, 4)->nullable(); 
            $table->double('mtoopergratuitas', 10, 4)->nullable();
            $table->double('mtoigv', 10, 4)->nullable();
            $table->double('mtoigvgratuitas', 10, 4)->nullable();
            $table->double('icbper', 10, 4)->nullable();
            $table->double('totalimpuestos', 10, 4)->nullable();
            $table->double('valorventa', 10, 4)->nullable();
            $table->double('subtotal', 10, 4)->nullable();
            $table->double('redondeo', 10, 4)->nullable();
            $table->double('mtoimpventa', 10, 4)->nullable();
            $table->double('anticipos', 10, 4)->nullable();
            $table->double('detracciones', 10, 4)->nullable(); */


            $table->decimal('mtoopergravadas', 15, 4)->nullable();
            $table->decimal('mtooperexoneradas', 15, 4)->nullable();
            $table->decimal('mtooperinafectas', 15, 4)->nullable();
            $table->decimal('mtooperexportacion', 15, 4)->nullable();
            $table->decimal('mtoopergratuitas', 15, 4)->nullable();
            $table->decimal('mtoigv', 15, 4)->nullable();
            $table->decimal('mtoigvgratuitas', 15, 4)->nullable();
            $table->decimal('icbper', 15, 4)->nullable();
            $table->decimal('totalimpuestos', 15, 4)->nullable();
            $table->decimal('valorventa', 15, 4)->nullable();
            $table->decimal('subtotal', 15, 4)->nullable();
            $table->decimal('redondeo', 15, 4)->nullable();
            $table->decimal('mtoimpventa', 15, 4)->nullable();
            $table->decimal('anticipos', 15, 4)->nullable();
            $table->decimal('detracciones', 15, 4)->nullable();


            $table->text('legends')->nullable();
            $table->text('nota')->nullable();
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
        Schema::dropIfExists('comprobantes');
    }
};
