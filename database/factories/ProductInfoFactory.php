<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Orders\Models\ProductInfo;
use Faker\Generator as Faker;

$factory->define(ProductInfo::class, function (Faker $faker) {
    return [
            'number_of_items' => $faker->randomDigit,
    ];
});