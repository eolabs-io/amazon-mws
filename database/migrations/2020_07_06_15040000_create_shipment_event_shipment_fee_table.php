<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreateShipmentEventShipmentFeeTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_component_shipment_fee', function (Blueprint $table) {
            $table->primary(['fee_component_id', 'shipment_event_id'], 'fc_se');
            $table->unsignedBigInteger('fee_component_id')->index('fc_se_fc_id');
            $table->unsignedBigInteger('shipment_event_id')->index('fc_se_se_id');
            $table->timestamps();

            $table->foreign('shipment_event_id', 'fc_se_se_id_primary')->references('id')->on('shipment_events')->onDelete('cascade');
            $table->foreign('fee_component_id', 'fc_se_fc_id_primary')->references('id')->on('fee_components')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fee_component_shipment_fee');
    }
}
