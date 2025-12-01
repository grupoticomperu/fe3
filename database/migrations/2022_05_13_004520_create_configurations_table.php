<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Configuration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();

            $table->string('logo')->nullable();
            $table->enum('typeimage', [Configuration::AWS, Configuration::LOCAL, Configuration::STORAGE])->default(Configuration::STORAGE);
            $table->string('razonsocial')->nullable();
            $table->string('ruc', 11)->nullable();
            $table->string('certificado')->nullable();
            $table->boolean('state')->default(false);
            $table->timestamp('fechainicio')->nullable();
            $table->timestamp('fechafin')->nullable();
            $table->boolean('incluirigv')->default(true);
            $table->boolean('withcategory')->default(true);//1 true es con categoria y subcategoria,  0 sin categoria
            $table->text('nota1')->nullable();
            $table->text('nota2')->nullable();
            $table->text('nota3')->nullable();
            $table->double('igv')->default(18);

            $table->integer('numdecimalesproducto')->nullable();//se agrego
            $table->integer('numdecimalescomprobante')->nullable();//se agrego

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
        Schema::dropIfExists('configurations');
    }
};
