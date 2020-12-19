<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmazonFulfilledShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amazon_fulfilled_shipments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('amazon_order_id');
            $table->string('merchant_order_id')->nullable();
            $table->string('shipment_id');
            $table->string('shipment_item_id');
            $table->string('amazon_order_item_id');
            $table->string('merchant_order_item_id')->nullable();
            $table->dateTime('purchase_date')->nullable();
            $table->dateTime('payments_date')->nullable();
            $table->dateTime('shipment_date');
            $table->dateTime('reporting_date');
            $table->string('buyer_email');
            $table->string('buyer_name')->nullable();
            $table->string('buyer_phone_number')->nullable();
            $table->string('sku');
            $table->string('product_name');
            $table->string('quantity_shipped');
            $table->string('currency');
            $table->float('item_price')->nullable();
            $table->float('item_tax')->nullable();
            $table->float('shipping_price')->nullable();
            $table->float('shipping_tax')->nullable();
            $table->float('gift_wrap_price')->nullable();
            $table->float('gift_wrap_tax')->nullable();
            $table->string('ship_service_level');
            $table->string('recipient_name');
            $table->string('ship_address_1');
            $table->string('ship_address_2')->nullable();
            $table->string('ship_address_3')->nullable();
            $table->string('ship_city');
            $table->string('ship_state');
            $table->string('ship_postal_code');
            $table->string('ship_country');
            $table->string('ship_phone_number')->nullable();
            $table->string('bill_address_1')->nullable();
            $table->string('bill_address_2')->nullable();
            $table->string('bill_address_3')->nullable();
            $table->string('bill_city')->nullable();
            $table->string('bill_state')->nullable();
            $table->string('bill_postal_code')->nullable();
            $table->string('bill_country')->nullable();
            $table->float('item_promotion_discount')->nullable();
            $table->float('ship_promotion_discount')->nullable();
            $table->string('carrier');
            $table->string('tracking_number');
            $table->dateTime('estimated_arrival_date');
            $table->string('fulfillment_center_id');
            $table->string('fulfillment_channel');
            $table->string('sales_channel');
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
        Schema::dropIfExists('amazon_fulfilled_shipments');
    }
}
