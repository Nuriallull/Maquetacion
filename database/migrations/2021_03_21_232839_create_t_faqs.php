<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTFaqs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_faqs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->boolean('active')->default(false);
            $table->unsignedInteger('category_id');
            $table->integer('order')->default(0);
            $table->foreign('category_id')->references('id')->on('t_faqs_categories')->onUpdate('cascade');
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
        Schema::dropIfExists('t_faqs');
    }
}
