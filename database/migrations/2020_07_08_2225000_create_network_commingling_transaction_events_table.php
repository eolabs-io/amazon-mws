<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNetworkComminglingTransactionEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('network_commingling_transaction_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('posted_date')->nullable();
            $table->string('net_co_transaction_id')->nullable();
            $table->string('swap_reason')->nullable();
            $table->string('transaction_type')->nullable();
            $table->string('asin')->nullable();
            $table->string('marketplace_id')->nullable();
            $table->unsignedBigInteger('tax_exclusive_amount_id')->nullable();
            $table->unsignedBigInteger('tax_amount_id')->nullable();
            $table->timestamps();

            $table->foreign('tax_exclusive_amount_id', 'ncte_tax_exclusive_amount_id_foreign')->references('id')->on('currency_amounts');
            $table->foreign('tax_amount_id', 'ncte_tax_amount_id_foreign')->references('id')->on('currency_amounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('network_commingling_transaction_events');
    }
}
