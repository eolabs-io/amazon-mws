<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreateShipmentItemAdjustmentablesTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_item_adjustmentables', function (Blueprint $table) {
            $table->integer('shipment_item_id');
            $table->string('shipment_itemable_id');
            $table->string('shipment_itemable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_item_adjustmentables');
    }
}
