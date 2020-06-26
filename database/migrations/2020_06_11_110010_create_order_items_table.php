<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('amazon_order_id');
            $table->string('ASIN');
            $table->string('order_item_id');
            $table->string('seller_sku')->nullable();
            $table->unsignedBigInteger('buyer_customized_info_id')->nullable();
            $table->string('title')->nullable();
            $table->integer('quantity_ordered');
            $table->integer('quantity_shipped')->nullable();
            $table->unsignedBigInteger('points_granted_id')->nullable();
            $table->unsignedBigInteger('product_info_id')->nullable();
            $table->unsignedBigInteger('item_price_id')->nullable();
            $table->unsignedBigInteger('shipping_price_id')->nullable();
            $table->unsignedBigInteger('gift_wrap_price_id')->nullable();
            $table->unsignedBigInteger('tax_collection_id')->nullable();
            $table->unsignedBigInteger('item_tax_id')->nullable();
            $table->unsignedBigInteger('shipping_tax_id')->nullable();
            $table->unsignedBigInteger('gift_wrap_tax_id')->nullable();
            $table->unsignedBigInteger('shipping_discount_id')->nullable();
            $table->unsignedBigInteger('shipping_discount_tax_id')->nullable();
            $table->unsignedBigInteger('promotion_discount_id')->nullable();
            $table->unsignedBigInteger('promotion_discount_tax_id')->nullable();
            // PromotionIds
            $table->unsignedBigInteger('cod_fee_id')->nullable();
            $table->unsignedBigInteger('cod_fee_discount_id')->nullable();
            $table->boolean('is_gift')->nullable(); 
            $table->string('gift_message_text')->nullable();
            $table->string('gift_wrap_level')->nullable();
            $table->string('condition_note')->nullable();
            $table->string('condition_id')->nullable();
            $table->string('condition_subtype_id')->nullable();
            $table->dateTime('scheduled_delivery_start_date')->nullable();
            $table->dateTime('scheduled_delivery_end_date')->nullable();
            $table->string('price_designation')->nullable();
            $table->boolean('is_transparency')->nullable(); 
            $table->boolean('serial_number_required')->nullable(); 
            $table->timestamps();

            $table->foreign('amazon_order_id')->references('amazon_order_id')->on('orders');
            $table->foreign('buyer_customized_info_id')->references('id')->on('buyer_customized_infos')->onDelete('cascade');
            $table->foreign('points_granted_id')->references('id')->on('points_granteds')->onDelete('cascade');
            $table->foreign('product_info_id')->references('id')->on('product_infos')->onDelete('cascade');
            $table->foreign('item_price_id')->references('id')->on('money')->onDelete('cascade');
            $table->foreign('shipping_price_id')->references('id')->on('money')->onDelete('cascade');
            $table->foreign('gift_wrap_price_id')->references('id')->on('money')->onDelete('cascade');
            $table->foreign('tax_collection_id')->references('id')->on('tax_collections')->onDelete('cascade');
            $table->foreign('item_tax_id')->references('id')->on('money')->onDelete('cascade');
            $table->foreign('shipping_tax_id')->references('id')->on('money')->onDelete('cascade');
            $table->foreign('gift_wrap_tax_id')->references('id')->on('money')->onDelete('cascade');
            $table->foreign('shipping_discount_id')->references('id')->on('money')->onDelete('cascade');
            $table->foreign('shipping_discount_tax_id')->references('id')->on('money')->onDelete('cascade');
            $table->foreign('promotion_discount_id')->references('id')->on('money')->onDelete('cascade');
            $table->foreign('promotion_discount_tax_id')->references('id')->on('money')->onDelete('cascade');
            // PromotionIds
            $table->foreign('cod_fee_id')->references('id')->on('money')->onDelete('cascade');
            $table->foreign('cod_fee_discount_id')->references('id')->on('money')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
