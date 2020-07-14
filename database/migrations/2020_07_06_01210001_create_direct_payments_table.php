<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateDirectPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('direct_payment_type')->nullable();
            $table->unsignedBigInteger('direct_payment_amount_id')->nullable();
            $table->timestamps();

            $table->foreign('direct_payment_amount_id')->references('id')->on('currency_amounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('direct_payments');
    }
}
