<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreateDebtRecoveryEventsTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debt_recovery_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('debt_recovery_type')->nullable();
            $table->unsignedBigInteger('recovery_amount_id')->nullable();
            $table->unsignedBigInteger('over_payment_credit_id')->nullable();
            $table->timestamps();

            $table->foreign('recovery_amount_id')->references('id')->on('currency_amounts');
            $table->foreign('over_payment_credit_id')->references('id')->on('currency_amounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('debt_recovery_events');
    }
}
