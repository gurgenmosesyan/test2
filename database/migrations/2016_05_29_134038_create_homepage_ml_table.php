<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomepageMlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homepage_ml', function (Blueprint $table) {
            $table->tinyInteger('lng_id')->unsigned();
            $table->text('about_text');
            $table->text('offers_text');
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
        Schema::drop('homepage_ml');
    }
}
