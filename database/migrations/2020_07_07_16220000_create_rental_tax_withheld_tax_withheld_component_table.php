<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentalTaxWithheldTaxWithheldComponentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rental_tax_withheld_tax_withheld_component', function (Blueprint $table) {
            $table->primary(['tax_withheld_component_id', 'rental_transaction_event_id'], 'rtw_twc');
            $table->unsignedBigInteger('tax_withheld_component_id')->index('rtw_twc_twc_id');
            $table->unsignedBigInteger('rental_transaction_event_id')->index('rtw_twc_si_id');
            $table->timestamps();

            $table->foreign('rental_transaction_event_id', 'rtw_twc_si_id_primary')->references('id')->on('rental_transaction_events')->onDelete('cascade');
            $table->foreign('tax_withheld_component_id', 'rtw_twc_twc_id_primary')->references('id')->on('tax_withheld_components')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rental_tax_withheld_tax_withheld_component');
    }
}
