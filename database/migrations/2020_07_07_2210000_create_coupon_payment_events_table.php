<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreateCouponPaymentEventsTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_payment_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('posted_date')->nullable();
            $table->string('coupon_id')->nullable();
            $table->string('seller_coupon_description')->nullable();
            $table->integer('clip_or_redemption_count')->nullable();
            $table->string('payment_event_id')->nullable();
            $table->unsignedBigInteger('fee_component_id')->nullable();
            $table->unsignedBigInteger('charge_component_id')->nullable();
            $table->unsignedBigInteger('total_amount_id')->nullable();
            $table->timestamps();

            $table->foreign('fee_component_id')->references('id')->on('fee_components');
            $table->foreign('charge_component_id')->references('id')->on('charge_components');
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
        Schema::dropIfExists('coupon_payment_events');
    }
}
