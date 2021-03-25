<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreateServiceProviderCreditEventsTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_provider_credit_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('provider_transaction_type')->nullable();
            $table->string('seller_order_id')->nullable();
            $table->string('marketplace_id')->nullable();
            $table->string('marketplace_country_code')->nullable();
            $table->string('seller_id')->nullable();
            $table->string('seller_store_name')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('provider_store_name')->nullable();
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
        Schema::dropIfExists('service_provider_credit_events');
    }
}
