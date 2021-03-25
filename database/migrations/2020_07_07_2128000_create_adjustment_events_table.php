<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreateAdjustmentEventsTable extends AmazonMwsMigration
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
