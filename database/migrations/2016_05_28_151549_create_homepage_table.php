<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomepageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homepage', function (Blueprint $table) {
            $table->tinyInteger('lng_id')->unsigned();
            $table->text('about_text');
            $table->string('about_image');
            $table->text('offers_text');
            $table->string('offers_image');
            $table->primary('lng_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('homepage');
    }
}
