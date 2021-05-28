<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('entity',64)->nullable(true);
            $table->integer('key')->nullable(true)->index();
            $table->boolean('active')->default(false);
            $table->unsignedInteger('base_price');
            $table->unsignedInteger('total_price');
            $table->unsignedInteger('iva');
            $table->unsignedInteger('cesta_id');
            $table->integer('order')->default(0);
            $table->timestamps();
            $table->unsignedInteger('offer_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_product');
    }
}
