<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\TDSReimbursementEvent;
use Faker\Generator as Faker;

$factory->define(TDSReimbursementEvent::class, function (Faker $faker) {
    return [
			'posted_date' => $faker->dateTime(),
            'tds_order_id' => $faker->text(30),
            'reimbursed_amount_id' => function() {
            	return factory(CurrencyAmount::class)->create()->id;
            },
        ];
});