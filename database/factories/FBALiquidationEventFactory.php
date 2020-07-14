<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\FBALiquidationEvent;
use Faker\Generator as Faker;

$factory->define(FBALiquidationEvent::class, function (Faker $faker) {
    return [
    		'posted_date' => $faker->dateTime(),
            'original_removal_order_id' => $faker->text(),
            'liquidation_proceeds_amount_id' => function(){
            	return factory(CurrencyAmount::class)->create()->id;
            },
            'liquidation_fee_amount_id' => function(){
            	return factory(CurrencyAmount::class)->create()->id;
            },
    ];
});