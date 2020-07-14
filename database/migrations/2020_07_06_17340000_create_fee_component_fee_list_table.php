<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateFeeComponentFeeListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_component_fee_list', function (Blueprint $table) {
            $table->primary(['fee_component_id', 'pay_with_amazon_event_id'], 'fc_fl');
            $table->unsignedBigInteger('fee_component_id')->index('fc_fl_fc_id');
            $table->unsignedBigInteger('pay_with_amazon_event_id')->index('fc_fl_pwae_id');
            $table->timestamps();

            $table->foreign('pay_with_amazon_event_id', 'fc_fl_pwae_id_primary')->references('id')->on('pay_with_amazon_events')->onDelete('cascade');           
            $table->foreign('fee_component_id', 'fc_fl_fc_id_primary')->references('id')->on('fee_components')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fee_component_fee_list');
    }
}
