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
        Schema::create('resumens', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fechaescogida')->nullable();
            $table->timestamp('fechadeenvio')->nullable();
            $table->integer('numcomprobantes')->nullable();
            $table->double('inicio')->nullable();
            $table->double('fin')->nullable();
            $table->string('serie')->nullable();
            $table->string('xml')->nullable();
            $table->string('cdr')->nullable();
            $table->string('ticket')->nullable();
            $table->boolean('state')->nullable();


            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

            $table->unsignedBigInteger('local_id')->nullable();
            $table->foreign('local_id')->references('id')->on('locals')->onDelete('cascade');

            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');

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
        Schema::dropIfExists('resumens');
    }
};
