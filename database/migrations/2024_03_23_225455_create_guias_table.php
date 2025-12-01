<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    
    public function up()
    {
        Schema::create('guias', function (Blueprint $table) {
            $table->id();

            $table->string('serie');
            $table->integer('numero');
            $table->string('serienumero');
            $table->timestamp('fechaemision')->nullable();

            $table->unsignedBigInteger('comprobante_id')->nullable();
            $table->foreign('comprobante_id')->references('id')->on('comprobantes')->onDelete('cascade');

            $table->unsignedBigInteger('company_id')->nullable();//compañia que emite
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

            $table->unsignedBigInteger('customer_id')->nullable();//destinatario o cliente
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            //envio
            $table->unsignedBigInteger('motivotraslado_id')->nullable();
            $table->foreign('motivotraslado_id')->references('id')->on('motivotraslados')->onDelete('cascade');
            $table->string('modalidaddetraslado');
            $table->timestamp('fechadetraslado')->nullable();
            $table->double('pesototal', 10, 4)->nullable(); //peso del traslado
            $table->unsignedBigInteger('um_id')->nullable();
            $table->foreign('um_id')->references('id')->on('ums')->onDelete('cascade');
            $table->integer('numpaquetes')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('observacion')->nullable();
            //transportista
            $table->unsignedBigInteger('transportista_id')->nullable();
            $table->foreign('transportista_id')->references('id')->on('transportistas')->onDelete('cascade');
            //conductores
            //vehiculos
            //punto de partida
            $table->unsignedBigInteger('puntodepartida_id')->nullable();
            $table->foreign('puntodepartida_id')->references('id')->on('puntodepartidas')->onDelete('cascade');
            //punto de llegada
            $table->string('direccionllegada');
            $table->string('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->string('province_id')->nullable();
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->string('district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts');
            $table->string('ubigeollegada');
            $table->json('details');


            //$table->string('numdocumento');
            //$table->string('nombreorazonsocial');

            $table->unsignedBigInteger('paymenttype_id')->nullable();
            $table->foreign('paymenttype_id')->references('id')->on('paymenttypes')->onDelete('cascade');

            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');

            $table->unsignedBigInteger('tipodecambio_id')->nullable();
            $table->foreign('tipodecambio_id')->references('id')->on('tipodecambios')->onDelete('cascade');




            /* $table->unsignedBigInteger('sale_id')->nullable();
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade'); */

            $table->string('send_xml')->nullable();
            $table->string('sunat_success')->nullable();
            $table->text('sunat_error')->nullable();
            $table->string('hash')->nullable();
            $table->string('xml_path')->nullable();
            $table->string('pdf_path')->nullable();
            $table->string('sunat_cdr_path')->nullable();
            $table->text('cdr_code')->nullable();
            $table->text('cdr_notes')->nullable();
            $table->text('cdr_description')->nullable();





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
        Schema::dropIfExists('guias');
    }
};
