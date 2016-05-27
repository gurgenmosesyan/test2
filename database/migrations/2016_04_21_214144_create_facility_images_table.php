<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Core\Model;

class CreateFacilityImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('facility_id')->unsigned();
            $table->string('image');
            $table->enum('show_status', [Model::STATUS_ACTIVE, Model::STATUS_DELETED]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('facility_images');
    }
}
