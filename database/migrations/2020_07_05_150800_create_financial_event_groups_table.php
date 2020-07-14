<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateFinancialEventGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_event_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('financial_event_group_id')->nullable();
            $table->string('processing_status')->nullable();
            $table->string('fund_transfer_status')->nullable();
            $table->unsignedBigInteger('original_total_id')->nullable();
            $table->unsignedBigInteger('converted_total_id')->nullable();
            $table->dateTime('fund_transfer_date')->nullable();
            $table->string('trace_id')->nullable();
            $table->string('account_tail')->nullable();
            $table->unsignedBigInteger('beginning_balance_id')->nullable();
            $table->dateTime('financial_event_group_start')->nullable();
            $table->dateTime('financial_event_group_end')->nullable();
            $table->timestamps();

            $table->foreign('original_total_id')->references('id')->on('currency_amounts');
            $table->foreign('converted_total_id')->references('id')->on('currency_amounts');
            $table->foreign('beginning_balance_id')->references('id')->on('currency_amounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financial_event_groups');
    }
}
