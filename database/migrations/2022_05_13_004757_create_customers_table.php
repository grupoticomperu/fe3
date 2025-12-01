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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('tipodocumento_id')->nullable(); //dni ruc
            $table->foreign('tipodocumento_id')->references('id')->on('tipodocumentos')->onDelete('cascade');

            $table->string('numdoc')->unique();
            $table->string('nomrazonsocial')->unique();
            $table->string('nombrecomercial')->nullable();
            $table->string('address')->nullable();

            $table->string('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments');

            $table->string('province_id')->nullable();
            $table->foreign('province_id')->references('id')->on('provinces');

            $table->string('district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts');

            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');


            $table->string('phone')->nullable();
            $table->string('movil')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->string('email2')->nullable();
            $table->string('email3')->nullable();
            $table->string('email4')->nullable();
            $table->string('contact')->nullable();
            $table->boolean('state')->nullable();

            //$table->unsignedBigInteger('user_id')->nullable();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');


            // Agrega la restricción única en la combinación de rucodni con numdoc y company_id
            $table->unique(['numdoc', 'company_id']);


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
        Schema::dropIfExists('customers');
    }
};
