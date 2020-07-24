<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Products\Models\PackageDimension;
use Faker\Generator as Faker;

$factory->define(PackageDimension::class, function (Faker $faker) {
    return [
            'height' => $faker->randomFloat(2, 0, 9999999),
            'length' => $faker->randomFloat(2, 0, 9999999),
            'width' => $faker->randomFloat(2, 0, 9999999),
            'weight' => $faker->randomFloat(2, 0, 9999999),
            'dimension_units' => $faker->randomElement(['inch', 'cm']),
            'weight_units' => $faker->randomElement(['oz', 'lbs', 'kg']),
    ];
});