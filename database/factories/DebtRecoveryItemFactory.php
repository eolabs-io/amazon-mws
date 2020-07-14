<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\DebtRecoveryItem;
use Faker\Generator as Faker;

$factory->define(DebtRecoveryItem::class, function (Faker $faker) {
    return [
            'recovery_amount_id' => function(){
            	return factory(CurrencyAmount::class)->create()->id;
            },
            'original_amount_id' => function(){
            	return factory(CurrencyAmount::class)->create()->id;
            },
            'group_begin_date' => $faker->dateTime(),
        	'group_end_date' => $faker->dateTime(),
    ];
});