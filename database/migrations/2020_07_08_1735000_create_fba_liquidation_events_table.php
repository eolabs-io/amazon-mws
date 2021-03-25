<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreateFBALiquidationEventsTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fba_liquidation_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('posted_date')->nullable();
            $table->string('original_removal_order_id')->nullable();
            $table->unsignedBigInteger('liquidation_proceeds_amount_id')->nullable();
            $table->unsignedBigInteger('liquidation_fee_amount_id')->nullable();
            $table->timestamps();

            $table->foreign('liquidation_proceeds_amount_id')->references('id')->on('currency_amounts');
            $table->foreign('liquidation_fee_amount_id')->references('id')->on('currency_amounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fba_liquidation_events');
    }
}
