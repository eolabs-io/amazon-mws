<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateImagingServicesFeeEventsTable extends Migration
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
