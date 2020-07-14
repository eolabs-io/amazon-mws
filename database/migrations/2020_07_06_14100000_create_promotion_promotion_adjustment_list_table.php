<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionPromotionAdjustmentListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_promotion_adjustment_list', function (Blueprint $table) {
            $table->primary(['promotion_id', 'shipment_item_id'], 'pp_pal');
            $table->unsignedBigInteger('promotion_id')->index('pp_pal_p_id');
            $table->unsignedBigInteger('shipment_item_id')->index('pp_pal_si_id');
            $table->timestamps();

            $table->foreign('shipment_item_id', 'pp_pal_si_id_primary')->references('id')->on('shipment_items')->onDelete('cascade');           
            $table->foreign('promotion_id', 'pp_pal_p_id_primary')->references('id')->on('promotions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotion_promotion_adjustment_list');
    }
}
