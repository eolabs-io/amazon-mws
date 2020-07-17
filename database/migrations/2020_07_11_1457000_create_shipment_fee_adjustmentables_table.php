<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateShipmentFeeAdjustmentablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_fee_adjustmentables', function (Blueprint $table) {
            $table->integer('fee_component_id');
            $table->string('fee_componentable_id');
            $table->string('fee_componentable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_fee_adjustmentables');
    }
}