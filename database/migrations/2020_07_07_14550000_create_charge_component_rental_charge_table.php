<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreateChargeComponentRentalChargeTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charge_component_rental_charge', function (Blueprint $table) {
            $table->primary(['charge_component_id', 'rental_transaction_event_id'], 'cc_rc');
            $table->unsignedBigInteger('charge_component_id')->index('cc_rc_cc_id');
            $table->unsignedBigInteger('rental_transaction_event_id')->index('cc_rc_rce_id');
            $table->timestamps();

            $table->foreign('rental_transaction_event_id', 'cc_rc_rce_id_primary')->references('id')->on('rental_transaction_events')->onDelete('cascade');
            $table->foreign('charge_component_id', 'cc_rc_cc_id_primary')->references('id')->on('charge_components')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charge_component_rental_charge');
    }
}
