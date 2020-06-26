<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Orders\Models\Money;
use EolabsIo\AmazonMws\Domain\Orders\Models\PointsGranted;
use Faker\Generator as Faker;

$factory->define(PointsGranted::class, function (Faker $faker) {
    return [
            'points_number' => $faker->randomDigit,
            'points_monetary_value_id' => function() {
            	return factory(Money::class)->create()->id;
            },
    ];
});