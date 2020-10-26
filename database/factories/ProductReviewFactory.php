<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReview;

$factory->define(ProductReview::class, function (Faker $faker) {
    return [
            'asin' => $faker->text(30),
            'reviewId' => $faker->text(30),
            'profileName' => $faker->firstName,
            'starRating' => $faker->randomFloat(0, 5),
            'title' => $faker->text(10),
            'date' => $faker->date(),
            'verifiedPurchase' => $faker->boolean,
            'earlyReviewerRewards' => $faker->boolean,
            'vineVoice' => $faker->boolean,
            'body' => $faker->text(),
    ];
});
