<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreatePromotionPromotionListTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_promotion_list', function (Blueprint $table) {
            $table->primary(['promotion_id', 'shipment_item_id']);
            $table->unsignedBigInteger('promotion_id')->index();
            $table->unsignedBigInteger('shipment_item_id')->index();
            $table->timestamps();

            $table->foreign('shipment_item_id')->references('id')->on('shipment_items')->onDelete('cascade');
            $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotion_promotion_list');
    }
}
