<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCritics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('critics',function(Blueprint $table){
            $table->increments('criticid');
            $table->mediumText('comments');
            $table->integer('orderid')->unsigned();
            $table->smallInteger('coziness')->unsigned();
            $table->smallInteger('services')->unsigned();
            $table->smallInteger('menu')->unsigned();
            $table->boolean('status');
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('critics');
    }
}
