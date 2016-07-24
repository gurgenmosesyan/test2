<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderAccommodationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_accommodations', function (Blueprint $table) {
            $table->integer('order_id')->unsigned();
            $table->integer('accommodation_id')->unsigned();
            $table->primary(['order_id', 'accommodation_id'], 'order_acc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_accommodations');
    }
}
