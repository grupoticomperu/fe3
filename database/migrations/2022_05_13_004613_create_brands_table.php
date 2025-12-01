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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('state')->nullable();
            $table->string('image')->default('fe/default/brands/branddefault.jpg')->nullable();
            $table->integer('order')->nullable();

            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('keywords')->nullable();

            // Agrega la restricción única en la combinación de name y company_id
            $table->unique(['name', 'company_id']);

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
        Schema::dropIfExists('brands');
    }
};
