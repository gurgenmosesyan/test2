<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccommodationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodation_details', function (Blueprint $table) {
            $table->integer('accommodation_id')->unsigned();
            $table->tinyInteger('lng_id')->unsigned();
            $table->string('title');
            $table->integer('price')->unsigned();
            $table->smallInteger('index')->unsigned();
            $table->index(['accommodation_id', 'lng_id'], 'id_lng_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('accommodation_details');
    }
}
