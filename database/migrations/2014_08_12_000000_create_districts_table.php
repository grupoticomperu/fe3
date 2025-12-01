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
        Schema::create('districts', function (Blueprint $table) {
            $table->string('id');
            $table->primary('id');
            //$table->string('iddi')->nullable();
            $table->string('name')->nullable();
            $table->string('name2')->nullable();
            $table->string('province_id');
            $table->string('department_id');

            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
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
        Schema::dropIfExists('districts');
    }
};
