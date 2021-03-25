<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreatePackageDimensionsTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_dimensions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('height', 10, 2)->nullable();
            $table->float('length', 10, 2)->nullable();
            $table->float('width', 10, 2)->nullable();
            $table->float('weight', 10, 2)->nullable();
            $table->string('dimension_units')->nullable();
            $table->string('weight_units')->nullable();

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
        Schema::dropIfExists('package_dimensions');
    }
}
