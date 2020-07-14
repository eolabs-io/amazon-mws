<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\NetworkComminglingTransactionEvent;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use Faker\Generator as Faker;

$factory->define(NetworkComminglingTransactionEvent::class, function (Faker $faker) {
    return [
			'posted_date' => $faker->dateTime(),
            'net_co_transaction_id' => $faker->text(30),
            'swap_reason' => $faker->text(30),
            'transaction_type' => $faker->text(30),
            'asin' => $faker->text(30),
            'marketplace_id' => $faker->text(30),
            'tax_exclusive_amount_id' => function() {
            	return factory(CurrencyAmount::class)->create()->id;
            },
            'tax_amount_id' => function() {
            	return factory(CurrencyAmount::class)->create()->id;
            },
        ];
});