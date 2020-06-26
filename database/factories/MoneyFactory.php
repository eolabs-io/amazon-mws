<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Orders\Models\Money;
use Faker\Generator as Faker;

$factory->define(Money::class, function (Faker $faker) {
    return [
            'currency_code' => $faker->currencyCode,
            'amount' => (string) $faker->randomFloat(),
    ];
});