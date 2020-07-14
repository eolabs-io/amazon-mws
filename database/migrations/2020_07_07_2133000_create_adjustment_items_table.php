<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateAdjustmentItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adjustment_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('adjustment_event_id');
            $table->string('quantity')->nullable();
            $table->unsignedBigInteger('per_unit_amount_id')->nullable();
            $table->unsignedBigInteger('total_amount_id')->nullable();
            $table->string('seller_sku')->nullable();
            $table->string('fn_sku')->nullable();
            $table->string('product_description')->nullable();
            $table->string('asin')->nullable();
            $table->timestamps();

            $table->foreign('adjustment_event_id')->references('id')->on('adjustment_events');
            $table->foreign('per_unit_amount_id')->references('id')->on('currency_amounts');
            $table->foreign('total_amount_id')->references('id')->on('currency_amounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adjustment_items');
    }
}
