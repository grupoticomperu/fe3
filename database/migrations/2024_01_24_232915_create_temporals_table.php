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
        Schema::create('temporals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->string('codigobarras');
            $table->foreignId('employee_id')->constrained();//para identificarla venta del usuario o empleado
            $table->string('image')->nullable();
            $table->string('name');
            $table->string('um');
            $table->string('tipafeigv');
            $table->decimal('saleprice', 10, 4);
            $table->decimal('mtovalorunitario', 10, 4)->nullable();
            $table->decimal('porcentajeigv', 10, 4);
            $table->decimal('factoricbper', 10, 4);
            $table->decimal('discount', 10, 4)->nullable();
            $table->decimal('salepricef', 10, 4)->nullable();
            $table->integer('quantity');
            //$table->decimal('subtotal', 10, 4)->nullable();
            $table->decimal('subtotal', 10, 4)->nullable();
            $table->decimal('igv', 10, 4)->nullable();
            $table->decimal('totalimpuestos', 10, 4)->nullable();
            $table->decimal('icbper', 10, 4)->nullable();
            $table->decimal('mtovalorventa', 10, 4)->nullable();
            $table->decimal('mtobaseigv', 10, 4)->nullable();
           // $table->text('legends')->nullable();
           $table->boolean('esbolsa')->default(false);
           $table->boolean('state')->default(false);//si es 1 moestrar si es cero ocultar cero significa que ya mandaste a sunat
           $table->unsignedBigInteger('comprobante_id')->nullable();
            $table->foreign('comprobante_id')->references('id')->on('comprobantes')->onDelete('cascade');

           //$table->text('legends')->nullable(); ira en comprobante o boletas
            $table->timestamps();
            //$table->unique(['company_id', 'codigobarras', 'state']);//parece que aqui debemos agergar loca u usuario empreado
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temporals');
    }
};
