<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\RentalTransactionEvent;
use Faker\Generator as Faker;

$factory->define(RentalTransactionEvent::class, function (Faker $faker) {
    return [
            'amazon_order_id' => $faker->text(30),
            'rental_event_type' => $faker->randomElement(['RentalCustomerPayment', 'RentalChargeFailureReimbursement']),
            'extension_length' => $faker->numberBetween(1, 100),
            'posted_date' => $faker->dateTime(),
            'marketplace_name' => $faker->text(30),
            'rental_initial_value_id' => function() {
            	return factory(CurrencyAmount::class)->create()->id;
            },
            'rental_reimbursement_id' => function() {
            	return factory(CurrencyAmount::class)->create()->id;
            },
    ];
});