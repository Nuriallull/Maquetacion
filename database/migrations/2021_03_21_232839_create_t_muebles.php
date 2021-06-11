<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTMuebles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_muebles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->boolean('active')->default(false);
            $table->unsignedInteger('mueble_categoria_id');
            $table->foreign('category_id')->references('id')->on('t_muebles_categorias');
            $table->unsignedInteger('color_id');
            $table->unsignedInteger('tamaño_id');
            $table->integer('order')->default(0);
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
        Schema::dropIfExists('t_muebles');
    }
}
