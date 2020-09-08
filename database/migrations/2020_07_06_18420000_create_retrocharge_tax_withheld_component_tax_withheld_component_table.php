<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRetrochargeTaxWithheldComponentTaxWithheldComponentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retrocharge_tax_withheld_component_tax_withheld_component', function (Blueprint $table) {
            $table->primary(['retrocharge_event_id', 'tax_withheld_component_id'], 'rtwc_twc');
            $table->unsignedBigInteger('retrocharge_event_id')->index('rtwc_twc_re_id');
            $table->unsignedBigInteger('tax_withheld_component_id')->index('rtwc_twc_twc_id');
            $table->timestamps();

            $table->foreign('tax_withheld_component_id', 'rtwc_twc_twc_id_primary')->references('id')->on('tax_withheld_components')->onDelete('cascade');
            $table->foreign('retrocharge_event_id', 'rtwc_twc_re_id_primary')->references('id')->on('retrocharge_events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('retrocharge_tax_withheld_component_tax_withheld_component');
    }
}
