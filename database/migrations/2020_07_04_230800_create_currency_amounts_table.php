<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreateCurrencyAmountsTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_amounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('currency_code', 3);
            $table->float('currency_amount');
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
        Schema::dropIfExists('currency_amounts');
    }
}
