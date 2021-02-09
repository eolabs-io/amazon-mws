<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventorySuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_supplies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('seller_sku')->unique();
            $table->string('fnsku')->unique();
            $table->string('asin');
            $table->string('condition');
            $table->integer('total_supply_quantity')->nullable();
            $table->integer('in_stock_supply_quantity')->nullable();
            $table->unsignedBigInteger('earliest_availability_id')->nullable();
            $table->boolean('in_use')->default(true);
            $table->timestamps();

            $table->foreign('earliest_availability_id')->references('id')->on('timepoints');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_supplies');
    }
}
