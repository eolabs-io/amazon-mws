<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\LoanServicingEvent;
use Faker\Generator as Faker;

$factory->define(LoanServicingEvent::class, function (Faker $faker) {
    return [
            'source_business_event_type' => $faker->randomElement(['LoanAdvance', 'LoanPayment', 'LoanRefund']),
            'loan_amount_id' => function(){
            	return factory(CurrencyAmount::class)->create()->id;
            },
    ];
});