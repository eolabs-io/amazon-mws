<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeInstrument;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use Faker\Generator as Faker;

$factory->define(ChargeInstrument::class, function (Faker $faker) {
    return [
            'description' => $faker->text(),
            'tail' => $faker->text(),
            'amount_id' => function(){
            	return factory(CurrencyAmount::class)->create()->id;
            },
    ];
});