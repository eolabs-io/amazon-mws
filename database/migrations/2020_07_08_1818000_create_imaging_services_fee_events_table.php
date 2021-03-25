<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreateImagingServicesFeeEventsTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imaging_services_fee_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('imaging_request_billing_item_id')->nullable();
            $table->string('asin')->nullable();
            $table->dateTime('posted_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imaging_services_fee_events');
    }
}
