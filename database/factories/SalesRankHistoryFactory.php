<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Products\Models\SalesRankHistory;
use Faker\Generator as Faker;

$factory->define(SalesRankHistory::class, function (Faker $faker) {
    return [
            'asin' => $faker->text(10),
            'product_category_id' => $faker->text(10),
            'rank' => $faker->randomNumber(),
    ];
});
