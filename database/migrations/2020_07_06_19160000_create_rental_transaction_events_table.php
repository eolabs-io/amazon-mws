<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalTransactionEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rental_transaction_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('amazon_order_id')->nullable();
            $table->string('rental_event_type')->nullable();
            $table->integer('extension_length')->nullable();
            $table->dateTime('posted_date')->nullable();
            $table->string('marketplace_name')->nullable();
            $table->unsignedBigInteger('rental_initial_value_id')->nullable();
            $table->unsignedBigInteger('rental_reimbursement_id')->nullable();

            $table->timestamps();

            $table->foreign('rental_initial_value_id')->references('id')->on('currency_amounts');
            $table->foreign('rental_reimbursement_id')->references('id')->on('currency_amounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rental_transaction_events');
    }
}
