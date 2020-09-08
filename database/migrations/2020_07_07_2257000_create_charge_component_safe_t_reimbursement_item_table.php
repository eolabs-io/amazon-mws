<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChargeComponentSafeTReimbursementItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charge_component_safe_t_reimbursement_item', function (Blueprint $table) {
            $table->primary(['charge_component_id', 'safe_t_reimbursement_item_id'], 'cc_stri');
            $table->unsignedBigInteger('charge_component_id')->index('cc_stri_cc_id');
            $table->unsignedBigInteger('safe_t_reimbursement_item_id')->index('cc_stri_stri_id');
            $table->timestamps();

            $table->foreign('safe_t_reimbursement_item_id', 'cc_stri_stri_id_primary')->references('id')->on('safe_t_reimbursement_items')->onDelete('cascade');
            $table->foreign('charge_component_id', 'cc_stri_cc_id_primary')->references('id')->on('charge_components')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charge_component_safe_t_reimbursement_item');
    }
}
