<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\FinancialEventGroup;
use Faker\Generator as Faker;

$factory->define(FinancialEventGroup::class, function (Faker $faker) {

    return [
    		'financial_event_group_id' => $faker->text(30),
            'processing_status' => $faker->randomElement(['Open', 'Closed']),
            'fund_transfer_status' => $faker->text(30),
            'original_total_id' => function(){
                return factory(CurrencyAmount::class)->create()->id;
            },
            'converted_total_id' => function(){
                return factory(CurrencyAmount::class)->create()->id;
            },
            'fund_transfer_date' => $faker->dateTime(),
            'trace_id' => $faker->text(30),
            'account_tail' => $faker->text(30),
            'beginning_balance_id' => function(){
                return factory(CurrencyAmount::class)->create()->id;
            },
            'financial_event_group_start' => $faker->dateTime(),
            'financial_event_group_end' => $faker->dateTime(),
    ];
});