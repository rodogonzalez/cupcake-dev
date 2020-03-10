<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCupcakesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('stock_available');
            $table->float('address_lat')->nullable();          
            $table->float('address_lng')->nullable();          
            $table->boolean('is_eligible')->nullable();
            $table->timestamps();
        });
        

        Schema::create('stores_product_user_picks', function (Blueprint $table) {
            $table->bigIncrements('id');            
            $table->bigInteger('store_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();            
            $table->date('programmed_date_to_pick')->nullable();            
            $table->boolean('was_retired')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('store_id')->references('id')->on('stores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
        Schema::dropIfExists('stores_product_user_picks');
        
    }
}
