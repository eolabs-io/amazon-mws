<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\DebtRecoveryEvent;
use Faker\Generator as Faker;

$factory->define(DebtRecoveryEvent::class, function (Faker $faker) {
    return [
            'debt_recovery_type' => $faker->text(),
            'recovery_amount_id' => function(){
            	return factory(CurrencyAmount::class)->create()->id;
            },
            'over_payment_credit_id' => function(){
            	return factory(CurrencyAmount::class)->create()->id;
            },
    ];
});