<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreateShipmentItemsTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('seller_sku')->nullable();
            $table->string('order_item_id')->nullable();
            $table->string('order_adjustment_item_id')->nullable();
            $table->integer('quantity_shipped')->nullable();
            $table->unsignedBigInteger('cost_of_points_granted_id')->nullable();
            $table->unsignedBigInteger('cost_of_points_returned_id')->nullable();
            $table->timestamps();

            $table->foreign('cost_of_points_granted_id')->references('id')->on('currency_amounts');
            $table->foreign('cost_of_points_returned_id')->references('id')->on('currency_amounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_items');
    }
}
