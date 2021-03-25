<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreateTaxCollectionsTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_collections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('model');
            $table->string('responsible_party');
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
        Schema::dropIfExists('tax_collections');
    }
}
