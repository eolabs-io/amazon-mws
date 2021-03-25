<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreateFeeComponentItemFeeTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_component_item_fee', function (Blueprint $table) {
            $table->primary(['fee_component_id', 'shipment_item_id']);
            $table->unsignedBigInteger('fee_component_id')->index();
            $table->unsignedBigInteger('shipment_item_id')->index();
            $table->timestamps();

            $table->foreign('shipment_item_id')->references('id')->on('shipment_items')->onDelete('cascade');
            $table->foreign('fee_component_id')->references('id')->on('fee_components')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fee_component_item_fee');
    }
}
