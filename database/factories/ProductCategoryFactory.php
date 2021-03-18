<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use EolabsIo\AmazonMws\Domain\Products\Models\ProductCategory;

$factory->define(ProductCategory::class, function (Faker $faker) {
    return [
        'product_category_id' => $faker->randomNumber(),
        'product_category_name' => $faker->text(20),
        'parent_id' => null,
    ];
});
