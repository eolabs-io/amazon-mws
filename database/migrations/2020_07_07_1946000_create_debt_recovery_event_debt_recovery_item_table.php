<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateDebtRecoveryEventDebtRecoveryItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debt_recovery_event_debt_recovery_item', function (Blueprint $table) {
            $table->primary(['debt_recovery_event_id', 'debt_recovery_item_id'], 'dre_dri');
            $table->unsignedBigInteger('debt_recovery_event_id')->index('dre_dri_dre_id');
            $table->unsignedBigInteger('debt_recovery_item_id')->index('dre_dri_dri_id');
            $table->timestamps();

            $table->foreign('debt_recovery_item_id','dre_dri_dri_id_primary')->references('id')->on('debt_recovery_items')->onDelete('cascade');           
            $table->foreign('debt_recovery_event_id', 'dre_dri_dre_id_primary')->references('id')->on('debt_recovery_events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('debt_recovery_event_debt_recovery_item');
    }
}
