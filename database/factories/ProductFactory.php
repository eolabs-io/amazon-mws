<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Products\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
            'asin' => $faker->text(10),
            'marketplace_id' => $faker->text(30),
            'name' => $faker->text(20)
    ];
});
