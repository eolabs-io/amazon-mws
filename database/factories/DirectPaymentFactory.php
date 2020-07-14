<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\DirectPayment;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use Faker\Generator as Faker;

$factory->define(DirectPayment::class, function (Faker $faker) {
    return [
            'direct_payment_type' => $faker->randomElement(['StoredValueCardRevenue', 'StoredValueCardRefund', 'PrivateLabelCreditCardRevenue']),
            'direct_payment_amount_id' => function(){
            	return factory(CurrencyAmount::class)->create()->id;
            },
    ];
});