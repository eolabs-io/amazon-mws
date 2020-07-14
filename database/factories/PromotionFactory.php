<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\Promotion;
use Faker\Generator as Faker;

$factory->define(Promotion::class, function (Faker $faker) {
    return [
            'promotion_type' => $faker->text(30),
            'promotion_id' => $faker->text(30),
            'promotion_amount_id' => function(){
            	return factory(CurrencyAmount::class)->create()->id;
            },
    ];
});