<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use EolabsIo\AmazonMws\Domain\Reviews\Models\ReviewRatingHistory;

$factory->define(ReviewRatingHistory::class, function (Faker $faker) {
    return [
            'asin' => $faker->text(30),
            'ratings' => $faker->numberBetween(0, 99999),
            'average_stars_rating' => $faker->numberBetween(0, 99999),
    ];
});
