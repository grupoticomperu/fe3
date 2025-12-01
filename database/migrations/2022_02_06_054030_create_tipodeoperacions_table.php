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
        Schema::create('tipodeoperacions', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->text('descripcion');
            $table->string('comprobantesafectados');
            $table->boolean('state')->default(1);



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
        Schema::dropIfExists('tipodeoperacions');
    }
};
