<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Accommodation\Accommodation;

class CreateAccommodationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('price')->unsigned();
            $table->float('room_size')->unsigned();
            $table->enum('extra_bed', [Accommodation::EXTRA_BED_NO, Accommodation::EXTRA_BED_YES]);
            $table->integer('extra_bed_price')->unsigned();
            $table->integer('sort_order')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('accommodations');
    }
}
