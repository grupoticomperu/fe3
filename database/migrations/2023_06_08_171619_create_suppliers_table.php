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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();

            $table->string('numdoc')->unique();
            $table->string('nomrazonsocial')->unique();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('movil')->nullable();
            $table->string('email')->nullable();
            $table->string('contact')->nullable();
            $table->boolean('state')->default(true);

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('tipodocumento_id')->nullable();
            $table->foreign('tipodocumento_id')->references('id')->on('tipodocumentos')->onDelete('cascade');


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
        Schema::dropIfExists('suppliers');
    }
};
