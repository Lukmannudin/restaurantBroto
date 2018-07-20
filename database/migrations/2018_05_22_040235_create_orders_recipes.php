<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersRecipes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_recipes',function(Blueprint $table){
            $table->increments('order_recipes_id');
            $table->integer('recipeid')->unsigned();
            $table->integer('orderid')->unsigned();
            $table->integer('qtyOrderItem')->unsigned();
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_recipes');
    }
}
