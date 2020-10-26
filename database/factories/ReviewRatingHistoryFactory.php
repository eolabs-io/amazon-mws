<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use EolabsIo\AmazonMws\Domain\Reviews\Models\ReviewRatingHistory;

$factory->define(ReviewRatingHistory::class, function (Faker $faker) {
    return [
            'asin' => $faker->numerify('B###########'),
            'number_of_ratings' => $faker->numberBetween(0, 9999),
            'number_of_reviews' => $faker->numberBetween(0, 9999),
            'average_stars_rating' => $faker->randomFloat(0.0, 5.0),
    ];
});
