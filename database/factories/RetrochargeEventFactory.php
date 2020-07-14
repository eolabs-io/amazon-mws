<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\RetrochargeEvent;
use Faker\Generator as Faker;

$factory->define(RetrochargeEvent::class, function (Faker $faker) {

    return [
    		'retrocharge_event_type' => $faker->randomElement(['Retrocharge', 'RetrochargeReversal']),
            'amazon_order_id' => $faker->text(30),
            'posted_date' => $faker->dateTime(),
            'base_tax_id' => function(){
                return factory(CurrencyAmount::class)->create()->id;
            },
            'shipping_tax_id' => function(){
                return factory(CurrencyAmount::class)->create()->id;
            },
            'marketplace_name' => $faker->text(30),
    ];
});