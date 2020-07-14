<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemTaxWithheldTaxWithheldComponentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_tax_withheld_tax_withheld_component', function (Blueprint $table) {
            $table->primary(['tax_withheld_component_id', 'shipment_item_id'], 'twc_si');
            $table->unsignedBigInteger('tax_withheld_component_id')->index('twc_si_twc_id');
            $table->unsignedBigInteger('shipment_item_id')->index('twc_si_si_id');
            $table->timestamps();

            $table->foreign('shipment_item_id', 'twc_si_si_id_primary')->references('id')->on('shipment_items')->onDelete('cascade');           
            $table->foreign('tax_withheld_component_id', 'twc_si_twc_id_primary')->references('id')->on('tax_withheld_components')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_tax_withheld_tax_withheld_component');
    }
}
