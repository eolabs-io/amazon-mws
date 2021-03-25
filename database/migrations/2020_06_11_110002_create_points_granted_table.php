<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreatePointsGrantedTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points_granteds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('points_number');
            $table->unsignedBigInteger('points_monetary_value_id');
            $table->timestamps();

            $table->foreign('points_monetary_value_id')->references('id')->on('money');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('points_granteds');
    }
}
