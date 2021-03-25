<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreateChargeComponentsTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charge_components', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('charge_type')->nullable();
            $table->unsignedBigInteger('charge_amount_id')->nullable();
            $table->timestamps();

            $table->foreign('charge_amount_id')->references('id')->on('currency_amounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charge_components');
    }
}
