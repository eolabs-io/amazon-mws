<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateSellerReviewEnrollmentPaymentEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_review_enrollment_payment_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('posted_date')->nullable();
            $table->string('enrollment_id')->nullable();
            $table->string('parent_asin')->nullable();
            $table->unsignedBigInteger('fee_component_id')->nullable();
            $table->unsignedBigInteger('charge_component_id')->nullable();
            $table->unsignedBigInteger('total_amount_id')->nullable();
            $table->timestamps();

            $table->foreign('fee_component_id', 'srepe_fee_component_id_foreign')->references('id')->on('fee_components');
            $table->foreign('charge_component_id', 'srepe_charge_component_id_foreign')->references('id')->on('charge_components');
            $table->foreign('total_amount_id', 'srepe_total_amount_id_foreign')->references('id')->on('currency_amounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seller_review_enrollment_payment_events');
    }
}
