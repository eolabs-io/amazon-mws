<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreateDirectPaymentFeeComponentTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_payment_direct_payment_list', function (Blueprint $table) {
            $table->primary(['direct_payment_id', 'shipment_event_id'], 'dp_dpl');
            $table->unsignedBigInteger('direct_payment_id')->index('dp_dpl_dp_id');
            $table->unsignedBigInteger('shipment_event_id')->index('dp_dpl_se_id');
            $table->timestamps();

            $table->foreign('shipment_event_id', 'dp_dpl_se_id_primary')->references('id')->on('shipment_events')->onDelete('cascade');
            $table->foreign('direct_payment_id', 'dp_dpl_dp_id_primary')->references('id')->on('direct_payments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('direct_payment_direct_payment_list');
    }
}
