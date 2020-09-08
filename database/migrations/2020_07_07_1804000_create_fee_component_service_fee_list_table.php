<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeeComponentServicefeeListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_component_service_fee_list', function (Blueprint $table) {
            $table->primary(['fee_component_id', 'service_fee_event_id'], 'fc_sfl');
            $table->unsignedBigInteger('fee_component_id')->index('fc_sfl_fc_id');
            $table->unsignedBigInteger('service_fee_event_id')->index('fc_sfl_sfe_id');
            $table->timestamps();

            $table->foreign('service_fee_event_id', 'fc_sfl_sfe_id_primary')->references('id')->on('service_fee_events')->onDelete('cascade');
            $table->foreign('fee_component_id', 'fc_sfl_fc_id_primary')->references('id')->on('fee_components')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fee_component_service_fee_list');
    }
}
