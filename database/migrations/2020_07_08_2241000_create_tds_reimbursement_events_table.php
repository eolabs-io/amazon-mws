<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreateTDSReimbursementEventsTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tds_reimbursement_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('posted_date')->nullable();
            $table->string('tds_order_id')->nullable();
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
        Schema::dropIfExists('tds_reimbursement_events');
    }
}
