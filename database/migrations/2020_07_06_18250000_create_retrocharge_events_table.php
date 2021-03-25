<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreateRetrochargeEventsTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retrocharge_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('retrocharge_event_type')->nullable();
            $table->string('amazon_order_id')->nullable();
            $table->dateTime('posted_date')->nullable();
            $table->unsignedBigInteger('base_tax_id')->nullable();
            $table->unsignedBigInteger('shipping_tax_id')->nullable();
            $table->string('marketplace_name')->nullable();
            $table->timestamps();

            $table->foreign('base_tax_id')->references('id')->on('currency_amounts');
            $table->foreign('shipping_tax_id')->references('id')->on('currency_amounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('retrocharge_events');
    }
}
