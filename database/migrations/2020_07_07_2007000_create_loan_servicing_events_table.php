<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateLoanServicingEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_servicing_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('source_business_event_type')->nullable();
            $table->unsignedBigInteger('loan_amount_id')->nullable();
            $table->timestamps();

            $table->foreign('loan_amount_id')->references('id')->on('currency_amounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_servicing_events');
    }
}
