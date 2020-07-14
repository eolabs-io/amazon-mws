<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\ProductAdsPaymentEvent;
use Faker\Generator as Faker;

$factory->define(ProductAdsPaymentEvent::class, function (Faker $faker) {
    return [
    		'posted_date' => $faker->dateTime(),
            'transaction_type' => $faker->randomElement(['Charge', 'Refund',]),
            'invoice_id' => $faker->text(30),
            'base_value_id' => function(){
            	return factory(CurrencyAmount::class)->create()->id;
            },
            'tax_value_id' => function(){
            	return factory(CurrencyAmount::class)->create()->id;
            },
            'transaction_value_id' => function(){
            	return factory(CurrencyAmount::class)->create()->id;
            },
    ];
});