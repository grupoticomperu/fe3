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
        Schema::create('boletadisenos', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('nameblade')->unique();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->boolean('state')->default(1);
            $table->integer('order')->nullable();
            $table->text('description')->nullable();

            /* $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade'); */
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
        Schema::dropIfExists('boletadisenos');
    }
};
