<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreateServiceFeeEventsTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_fee_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('amazon_order_id')->nullable();
            $table->string('fee_reason')->nullable();
            $table->string('seller_sku')->nullable();
            $table->string('fn_sku')->nullable();
            $table->string('fee_description')->nullable();
            $table->string('asin')->nullable();
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
        Schema::dropIfExists('service_fee_events');
    }
}
