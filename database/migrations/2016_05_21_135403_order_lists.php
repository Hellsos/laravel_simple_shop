<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderLists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('order_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);             
            $table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->decimal('price',10,2);
            $table->decimal('price_without_vat',10,2);
            $table->tinyInteger('status_order');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('order_lists');
    }
}
