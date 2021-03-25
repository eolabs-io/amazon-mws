<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreateAffordabilityExpenseEventsTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affordability_expense_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('posted_date')->nullable();
            $table->string('transaction_type')->nullable();
            $table->string('amazon_order_id')->nullable();
            $table->unsignedBigInteger('base_expense_id')->nullable();
            $table->unsignedBigInteger('total_expense_id')->nullable();
            $table->unsignedBigInteger('tax_type_igst_id');
            $table->unsignedBigInteger('tax_type_cgst_id');
            $table->unsignedBigInteger('tax_type_sgst_id');
            $table->string('marketplace_id')->nullable();
            $table->timestamps();

            $table->foreign('base_expense_id')->references('id')->on('currency_amounts');
            $table->foreign('total_expense_id')->references('id')->on('currency_amounts');
            $table->foreign('tax_type_igst_id')->references('id')->on('currency_amounts');
            $table->foreign('tax_type_cgst_id')->references('id')->on('currency_amounts');
            $table->foreign('tax_type_sgst_id')->references('id')->on('currency_amounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('affordability_expense_events');
    }
}
