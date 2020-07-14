<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use Faker\Generator as Faker;

$factory->define(CurrencyAmount::class, function (Faker $faker) {
    return [
            'currency_code' => $faker->currencyCode,
            'currency_amount' => $faker->randomFloat(2, 0, 99999),
    ];
});