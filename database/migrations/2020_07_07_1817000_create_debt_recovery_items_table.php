<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreateDebtRecoveryItemsTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debt_recovery_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('recovery_amount_id')->nullable();
            $table->unsignedBigInteger('original_amount_id')->nullable();
            $table->dateTime('group_begin_date')->nullable();
            $table->dateTime('group_end_date')->nullable();
            $table->timestamps();

            $table->foreign('recovery_amount_id')->references('id')->on('currency_amounts');
            $table->foreign('original_amount_id')->references('id')->on('currency_amounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('debt_recovery_items');
    }
}
