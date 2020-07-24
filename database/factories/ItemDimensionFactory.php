<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Products\Models\ItemDimension;
use Faker\Generator as Faker;

$factory->define(ItemDimension::class, function (Faker $faker) {
    return [
            'height' => $faker->randomFloat(2, 0, 9999999),
            'length' => $faker->randomFloat(2, 0, 99999999),
            'width' => $faker->randomFloat(2, 0, 99999999),
            'units' => $faker->randomElement(['inch', 'cm']),
    ];
});