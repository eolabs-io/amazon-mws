<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeeComponentItemFeeAdjustmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_component_item_fee_adjustment', function (Blueprint $table) {
            $table->primary(['fee_component_id', 'shipment_item_id'], 'fc_ifa');
            $table->unsignedBigInteger('fee_component_id')->index('fc_ifa_fc_id');
            $table->unsignedBigInteger('shipment_item_id')->index('fc_ifa_si_id');
            $table->timestamps();

            $table->foreign('shipment_item_id', 'fc_ifa_fc_id_primary')->references('id')->on('shipment_items')->onDelete('cascade');
            $table->foreign('fee_component_id', 'fc_ifa_si_id_primary')->references('id')->on('fee_components')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fee_component_item_fee_adjustment');
    }
}
