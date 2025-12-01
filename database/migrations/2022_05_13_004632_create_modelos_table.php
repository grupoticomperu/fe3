<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('modelos', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->boolean('state')->default(1);

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('modelos');
    }
};
