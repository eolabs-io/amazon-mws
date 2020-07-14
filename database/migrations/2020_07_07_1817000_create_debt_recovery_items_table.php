<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateDebtRecoveryItemsTable extends Migration
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
