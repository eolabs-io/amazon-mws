<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateAdjustmentEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adjustment_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('adjustment_type')->nullable();
            $table->unsignedBigInteger('adjustment_amount_id')->nullable();
            $table->dateTime('posted_date')->nullable();

            $table->timestamps();

            $table->foreign('adjustment_amount_id')->references('id')->on('currency_amounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adjustment_events');
    }
}
