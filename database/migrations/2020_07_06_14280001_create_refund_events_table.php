<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreateRefundEventsTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refund_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('amazon_order_id')->nullable();
            $table->string('seller_order_id')->nullable();
            $table->string('marketplace_name')->nullable();
            $table->datetime('posted_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refund_events');
    }
}
