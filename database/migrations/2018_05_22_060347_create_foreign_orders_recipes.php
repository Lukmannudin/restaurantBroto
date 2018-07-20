<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignOrdersRecipes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders_recipes',function(Blueprint $table){
            $table->foreign('orderid')
                  ->references('orderid')
                  ->on('orders')
                  ->onDelete('no action')
                  ->onUpdate('cascade');
            $table->foreign('recipeid')
                  ->references('recipeid')
                  ->onDelete('no action')
                  ->on('recipes')
                  ->onUpdate('cascade');
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign('orders_recipes_orderid_foreign'); 
        $table->dropForeign('orders_recipes_recipeid_foreign'); 
    }
}
