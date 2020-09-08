<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Reviews\Models\ReviewHistory;
use Faker\Generator as Faker;

$factory->define(ReviewHistory::class, function (Faker $faker) {
    return [
            'asin' => $faker->text(30),
            'rating' => $faker->numberBetween(0, 99999),
    ];
});
