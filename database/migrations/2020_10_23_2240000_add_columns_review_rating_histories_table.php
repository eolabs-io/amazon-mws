<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsReviewRatingHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('review_rating_histories', function (Blueprint $table) {
            $table->renameColumn('ratings', 'number_of_ratings');
        });

        Schema::table('review_rating_histories', function (Blueprint $table) {
            $table->integer('number_of_reviews')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // if (Schema::hasColumn('review_rating_histories', 'number_of_ratings')) {
        Schema::table('review_rating_histories', function ($table) {
            $table->renameColumn('number_of_ratings', 'ratings');
        });
        // }
        // if (Schema::hasColumn('review_rating_histories', 'number_of_reviews')) {
        Schema::table('review_rating_histories', function ($table) {
            $table->dropColumn('number_of_reviews');
        });
        // }
    }
}
