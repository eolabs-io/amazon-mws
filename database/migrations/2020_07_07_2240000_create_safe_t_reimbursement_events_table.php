<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateSafeTReimbursementEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('safe_t_reimbursement_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('posted_date');
            $table->string('safe_t_claim_id');
            $table->unsignedBigInteger('reimbursed_amount_id')->nullable();
            $table->timestamps();

            $table->foreign('reimbursed_amount_id')->references('id')->on('currency_amounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('safe_t_reimbursement_events');
    }
}
