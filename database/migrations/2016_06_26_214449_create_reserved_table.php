<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Reserved\Reserved;

class CreateReservedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserved', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('accommodation_id')->unsigned();
            $table->smallInteger('room_quantity')->unsigned();
            $table->date('date_from');
            $table->date('date_to');
            $table->enum('type', [Reserved::TYPE_CASH, Reserved::TYPE_AMERIA, Reserved::TYPE_ADMIN]);
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
        Schema::drop('reserved');
    }
}
