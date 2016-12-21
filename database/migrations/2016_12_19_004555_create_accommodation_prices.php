<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccommodationPrices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodation_prices', function (Blueprint $table) {
            $table->integer('accommodation_id')->unsigned();
            $table->string('start_date', '5');
            $table->string('end_date', '5');
            $table->integer('price')->unsigned();
            $table->index('accommodation_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('accommodation_prices');
    }
}
