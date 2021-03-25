<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreatePayWithAmazonEventsTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_with_amazon_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('seller_order_id')->nullable();
            $table->datetime('transaction_posted_date')->nullable();
            $table->string('business_object_type')->nullable();
            $table->string('sales_channel')->nullable();
            $table->unsignedBigInteger('charge_id')->nullable();
            $table->string('payment_amount_type')->nullable();
            $table->string('amount_description')->nullable();
            $table->string('fulfillment_channel')->nullable();
            $table->string('store_name')->nullable();
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
        Schema::dropIfExists('pay_with_amazon_events');
    }
}
