<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreateProductReviewImagesTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_review_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_review_id');
            $table->string('url');
            $table->timestamps();

            $table->foreign('product_review_id')->references('id')->on('product_reviews');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_review_images');
    }
}
