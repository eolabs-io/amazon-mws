<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateChargeInstrumentDebtRecoveryEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charge_instrument_debt_recovery_event', function (Blueprint $table) {
            $table->primary(['charge_instrument_id', 'debt_recovery_event_id'], 'ci_dre');
            $table->unsignedBigInteger('charge_instrument_id')->index('ci_dre_ci_id');
            $table->unsignedBigInteger('debt_recovery_event_id')->index('ci_dre_dre_id');
            $table->timestamps();

            $table->foreign('debt_recovery_event_id','ci_dre_dre_id_primary')->references('id')->on('debt_recovery_events')->onDelete('cascade');           
            $table->foreign('charge_instrument_id', 'ci_dre_ci_id_primary')->references('id')->on('charge_instruments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charge_instrument_debt_recovery_event');
    }
}
