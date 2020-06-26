<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventorySupplyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_supply_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('inventory_supply_id');
            $table->integer('quantity');
            $table->string('supply_type');
            $table->unsignedBigInteger('earliest_available_to_pick_id')->nullable();
            $table->unsignedBigInteger('latest_available_to_pick_id')->nullable();
            $table->timestamps();

            $table->foreign('inventory_supply_id')->references('id')->on('inventory_supplies');
            $table->foreign('earliest_available_to_pick_id')->references('id')->on('timepoints');
            $table->foreign('latest_available_to_pick_id')->references('id')->on('timepoints');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_supply_details');
    }
}
