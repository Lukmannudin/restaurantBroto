<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments',function(Blueprint $table){
            $table->increments('paymentid');
            $table->date('datePaid');   
            $table->double('received');
            $table->double('changes');
            $table->double('taxAmount');
            $table->double('serviceAmount');
            $table->double('amount');
            $table->enum('paymentMethod',['cash','cashless']);
            $table->integer('orderid')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
