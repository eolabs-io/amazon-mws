<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChargeComponentItemChargeAdjustmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charge_component_item_charge_adjustment', function (Blueprint $table) {
            $table->primary(['charge_component_id', 'shipment_item_id'], 'cc_ica');
            $table->unsignedBigInteger('charge_component_id')->index('cc_ica_cc_id');
            $table->unsignedBigInteger('shipment_item_id')->index('cc_ica_si_id');
            $table->timestamps();

            $table->foreign('shipment_item_id', 'cc_ica_si_id_primary')->references('id')->on('shipment_items')->onDelete('cascade');
            $table->foreign('charge_component_id', 'cc_ica_cc_id_primary')->references('id')->on('charge_components')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charge_component_item_charge_adjustment');
    }
}
