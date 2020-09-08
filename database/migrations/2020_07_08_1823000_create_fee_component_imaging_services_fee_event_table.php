<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeeComponentImagingServicesFeeEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_component_imaging_services_fee_event', function (Blueprint $table) {
            $table->primary(['fee_component_id', 'imaging_services_fee_event_id'], 'fc_isfe');
            $table->unsignedBigInteger('fee_component_id')->index('fc_isfe_fc_id');
            $table->unsignedBigInteger('imaging_services_fee_event_id')->index('fc_isfe_isfe_id');
            $table->timestamps();

            $table->foreign('imaging_services_fee_event_id', 'fc_isfe_isfe_id_primary')->references('id')->on('imaging_services_fee_events')->onDelete('cascade');
            $table->foreign('fee_component_id', 'fc_isfe_fc_id_primary')->references('id')->on('fee_components')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fee_component_imaging_services_fee_event');
    }
}
