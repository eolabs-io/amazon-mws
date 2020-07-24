<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Products\Models\Product;
use EolabsIo\AmazonMws\Domain\Products\Models\SalesRank;
use Faker\Generator as Faker;

$factory->define(SalesRank::class, function (Faker $faker) {
    return [
            'product_id' => function() {
            	return factory(Product::class)->create()->id;
            },
            'product_category_id' => $faker->text(10),
            'rank' => $faker->randomNumber(),
    ];
});