<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\SafeTReimbursementEvent;
use Faker\Generator as Faker;

$factory->define(SafeTReimbursementEvent::class, function (Faker $faker) {
    return [
            'posted_date' => $faker->dateTime(),
            'safe_t_claim_id' => $faker->text(),
            'reimbursed_amount_id' => function() {
            	return factory(CurrencyAmount::class)->create()->id;
            },
    ];
});