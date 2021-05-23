<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\AmazonMws\Domain\Shared\Migrations\AmazonMwsMigration;

class CreateProductReviewsTable extends AmazonMwsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('asin');
            $table->string('reviewId')->unique();
            $table->string('profileName');
            $table->float('starRating');
            $table->string('title');
            $table->date('date');
            $table->boolean('verifiedPurchase');
            $table->boolean('earlyReviewerRewards');
            $table->boolean('vineVoice');
            $table->text('body');
            $table->unsignedBigInteger('product_review_status_id')->nullable();
            $table->timestamps();

            $table->foreign('product_review_status_id')->references('id')->on('product_review_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_reviews');
    }
}
