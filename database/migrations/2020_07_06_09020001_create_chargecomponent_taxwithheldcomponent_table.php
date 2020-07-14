<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChargeComponentTaxWithheldComponentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charge_component_tax_withheld_component', function (Blueprint $table) {
            $table->primary(['charge_component_id', 'tax_withheld_component_id'], 'cc_tc');
            $table->unsignedBigInteger('charge_component_id')->index('cc');
            $table->unsignedBigInteger('tax_withheld_component_id')->index('cc_tc');
            $table->timestamps();

            $table->foreign('tax_withheld_component_id', 'cc_id_tc_id_primary')->references('id')->on('tax_withheld_components')->onDelete('cascade');           
            $table->foreign('charge_component_id', 'tc_id_cc_id_primary')->references('id')->on('charge_components')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charge_component_tax_withheld_component');
    }
}
