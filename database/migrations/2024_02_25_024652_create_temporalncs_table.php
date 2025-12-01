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
        Schema::create('temporalncs', function (Blueprint $table) {
            $table->id();
            //$table->string('serienumero');
            $table->foreignId('company_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->string('codigobarras');
            $table->foreignId('employee_id')->constrained();//para identificarla venta del usuario o empleado
            $table->string('image')->nullable();
            $table->string('name');
            $table->string('um');
            $table->string('tipafeigv');
            $table->double('saleprice', 10, 4);
            $table->double('mtovalorunitario', 10, 4)->nullable();
            $table->double('porcentajeigv', 10, 4);
            $table->double('factoricbper', 10, 4);
            $table->double('discount', 10, 4)->nullable();
            $table->double('salepricef', 10, 4)->nullable();
            $table->integer('quantity');
            //$table->double('subtotal', 10, 4)->nullable();
            $table->double('subtotal', 10, 4)->nullable();
            $table->double('igv', 10, 4)->nullable();
            $table->double('totalimpuestos', 10, 4)->nullable();
            $table->double('icbper', 10, 4)->nullable();
            $table->double('mtovalorventa', 10, 4)->nullable();
            $table->double('mtobaseigv', 10, 4)->nullable();
           // $table->text('legends')->nullable();
           $table->boolean('esbolsa')->default(false);
           //$table->text('legends')->nullable(); ira en comprobante o boletas
            $table->timestamps();
            $table->unique(['company_id', 'codigobarras']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temporalncs');
    }
};
