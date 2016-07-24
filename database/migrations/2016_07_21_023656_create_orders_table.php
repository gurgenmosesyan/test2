<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Order\Order;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', [Order::TYPE_CASH, Order::TYPE_AMERIA]);
            $table->string('order_id');
            $table->string('payment_id');
            $table->text('accommodations');
            $table->integer('price')->unsigned();
            $table->date('date_from');
            $table->date('date_to');
            $table->text('info');
            $table->string('phone');
            $table->string('email');
            $table->enum('status', [Order::STATUS_NOT_PAYED, Order::STATUS_PAYED]);
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
        Schema::drop('orders');
    }
}
