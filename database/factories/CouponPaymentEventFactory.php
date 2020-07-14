<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\CouponPaymentEvent;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;
use Faker\Generator as Faker;

$factory->define(CouponPaymentEvent::class, function (Faker $faker) {
    return [
            'posted_date' => $faker->dateTime(),
	        'coupon_id' => $faker->text(),
	        'seller_coupon_description' => $faker->text(),
	        'clip_or_redemption_count' => $faker->numberBetween(1,9999),
	        'payment_event_id' => $faker->text(),
            'fee_component_id' => function() {
            	return factory(FeeComponent::class)->create()->id;
            },
            'charge_component_id' => function() {
            	return factory(ChargeComponent::class)->create()->id;
            },
            'total_amount_id' => function() {
            	return factory(CurrencyAmount::class)->create()->id;
            },
    ];
});