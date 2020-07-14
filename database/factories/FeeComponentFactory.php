<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use Faker\Generator as Faker;

$factory->define(FeeComponent::class, function (Faker $faker) {
    return [
            'fee_type' => $faker->randomElement(['Commission', 'CouponClipFee', 'CouponRedemptionFee', 'CSBAFee']),
            'fee_amount_id' => function(){
            	return factory(CurrencyAmount::class)->create()->id;
            },
    ];
});