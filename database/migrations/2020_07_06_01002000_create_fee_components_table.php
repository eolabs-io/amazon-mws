<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreateFeeComponentsTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_components', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fee_type')->nullable();
            $table->unsignedBigInteger('fee_amount_id')->nullable();
            $table->timestamps();

            $table->foreign('fee_amount_id')->references('id')->on('currency_amounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fee_components');
    }
}
