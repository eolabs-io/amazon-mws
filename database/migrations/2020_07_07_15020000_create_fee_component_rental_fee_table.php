<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeeComponentRentalFeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_component_rental_fee', function (Blueprint $table) {
            $table->primary(['fee_component_id', 'rental_transaction_event_id'], 'fc_rte');
            $table->unsignedBigInteger('fee_component_id')->index('fc_rte_fc_id');
            $table->unsignedBigInteger('rental_transaction_event_id')->index('fc_rte_rte_id');
            $table->timestamps();

            $table->foreign('rental_transaction_event_id', 'fc_rte_rte_id_primary')->references('id')->on('rental_transaction_events')->onDelete('cascade');
            $table->foreign('fee_component_id', 'fc_rte_fc_id_primary')->references('id')->on('fee_components')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fee_component_rental_fee');
    }
}
