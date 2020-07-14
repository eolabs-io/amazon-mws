<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\AdjustmentEvent;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use Faker\Generator as Faker;

$factory->define(AdjustmentEvent::class, function (Faker $faker) {
    return [
            'adjustment_type' => $faker->randomElement(['FBAInventoryReimbursement', 'ReserveEvent', 'SellerRewards']),
            'adjustment_amount_id' => function() {
            	return factory(CurrencyAmount::class)->create()->id;
            },
            'posted_date' => $faker->dateTime(),
    ];
});