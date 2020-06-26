<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('amazon_order_id')->unique();
            $table->string('seller_order_id')->nullable();
            $table->dateTime('purchase_date');
            $table->dateTime('last_update_date');
            $table->string('order_status');
            $table->string('fulfillment_channel')->nullable();
            $table->string('sales_channel')->nullable();
            $table->string('order_channel')->nullable();
            $table->string('ship_service_level')->nullable();  
            $table->unsignedBigInteger('shipping_address_id')->nullable();
            $table->unsignedBigInteger('order_total_id')->nullable();    
            $table->integer('number_of_items_shipped')->nullable();
            $table->integer('number_of_items_unshipped')->nullable();
            // $table->unsignedBigInteger('payment_execution_detail_id')->nullable();  
            $table->string('payment_method')->nullable(); 
            $table->unsignedBigInteger('payment_method_details_id')->nullable(); 
            $table->boolean('is_replacement_order')->nullable(); 
            $table->string('replaced_order_id')->nullable(); 
            $table->string('market_place_id')->nullable(); 
            $table->string('buyer_email')->nullable(); 
            $table->string('buyer_name')->nullable(); 
            $table->string('buyer_county')->nullable(); 
            $table->unsignedBigInteger('buyer_tax_info_id')->nullable();
            $table->string('shipment_service_level_category')->nullable(); 
            $table->string('easy_ship_shipment_status')->nullable(); 
            $table->string('order_type')->nullable(); 
            $table->dateTime('earliest_ship_date')->nullable();
            $table->dateTime('latest_ship_date')->nullable();
            $table->dateTime('earliest_delivery_date')->nullable();
            $table->dateTime('latest_delivery_date')->nullable();
            $table->boolean('is_business_order')->nullable();             
            $table->boolean('is_sold_by_ab')->nullable(); 
            $table->string('purchase_order_number')->nullable(); 
            $table->boolean('is_prime')->nullable();             
            $table->boolean('is_premium_order')->nullable(); 
            $table->boolean('is_global_express_enabled')->nullable();  
            $table->dateTime('promise_response_due_date')->nullable();    
            $table->boolean('is_estimated_ship_dateset')->nullable(); 
            $table->unsignedBigInteger('store_id')->nullable();
            $table->timestamps();

            $table->foreign('shipping_address_id')->references('id')->on('addresses');
            $table->foreign('order_total_id')->references('id')->on('money')->onDelete('cascade');
            // $table->foreign('payment_execution_detail_id')->references('id')->on('payment_execution_detail_items')->onDelete('cascade');
            $table->foreign('payment_method_details_id')->references('id')->on('payment_method_details')->onDelete('cascade');
            $table->foreign('buyer_tax_info_id')->references('id')->on('buyer_tax_infos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
