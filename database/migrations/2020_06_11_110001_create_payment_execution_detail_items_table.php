<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentExecutionDetailItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_execution_detail_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('money_id');
            $table->string('payment_method');
            $table->unsignedBigInteger('order_id');
            $table->timestamps();

            $table->foreign('money_id')->references('id')->on('money');
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_execution_detail_items');
    }
}
