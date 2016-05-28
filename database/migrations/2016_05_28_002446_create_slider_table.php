<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Slider\Slider;

class CreateSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('key', [
                Slider::KEY_OFFERS,
                Slider::KEY_FACILITIES,
                Slider::KEY_EVENTS
            ]);
            $table->integer('facility_id')->unsigned();
            $table->integer('sort_order')->unigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('slider');
    }
}
