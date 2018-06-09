<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            //$table->integer('customer_id')->unsigned();

            $table->enum('status',['processing','processed']);
            $table->string('customer_name');
            $table->string('customer_address');
            $table->string('customer_tel');
            $table->string('customer_note')->nullable();

            $table->softDeletes();
            $table->timestamps();

//            $table->foreign('customer_id')
//                ->references('id')
//                ->on('users')
//                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
