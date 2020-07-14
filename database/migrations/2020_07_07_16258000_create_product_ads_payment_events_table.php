<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateProductAdsPaymentEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_ads_payment_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('posted_date')->nullable();
            $table->string('transaction_type')->nullable();
            $table->string('invoice_id')->nullable();
            $table->unsignedBigInteger('base_value_id')->nullable();
            $table->unsignedBigInteger('tax_value_id')->nullable();
            $table->unsignedBigInteger('transaction_value_id')->nullable();
            $table->timestamps();

            $table->foreign('base_value_id')->references('id')->on('currency_amounts');
            $table->foreign('tax_value_id')->references('id')->on('currency_amounts');
            $table->foreign('transaction_value_id')->references('id')->on('currency_amounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_ads_payment_events');
    }
}
