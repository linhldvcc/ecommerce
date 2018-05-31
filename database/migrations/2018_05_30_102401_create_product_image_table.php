<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductImageTable extends Migration
{
    public function up()
    {
        Schema::create('products_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('save_path');
            $table->string('original_name');
            $table->boolean('is_thumbnail')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('products_images');
    }
}
