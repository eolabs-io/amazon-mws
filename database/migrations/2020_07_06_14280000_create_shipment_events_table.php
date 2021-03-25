<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreateShipmentEventsTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('amazon_order_id')->nullable();
            $table->string('seller_order_id')->nullable();
            $table->string('marketplace_name')->nullable();
            $table->datetime('posted_date')->nullable();
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
        Schema::dropIfExists('shipment_events');
    }
}
