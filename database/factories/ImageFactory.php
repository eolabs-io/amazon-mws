<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Products\Models\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    return [
            'url' => $faker->url(),
            'height' => $faker->randomFloat(2, 0, 999999),
            'width' => $faker->randomFloat(2, 0, 999999),
            'units' => $faker->randomElement(['Pixels', 'inch', 'cm']),
    ];
});