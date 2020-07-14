<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\SellerReviewEnrollmentPaymentEvent;
use Faker\Generator as Faker;

$factory->define(SellerReviewEnrollmentPaymentEvent::class, function (Faker $faker) {
    return [
    		'posted_date' => $faker->dateTime(),
            'enrollment_id' => $faker->text(),
            'parent_asin' => $faker->text(),
            'fee_component_id' => function(){
            	return factory(FeeComponent::class)->create()->id;
            },
            'charge_component_id' => function(){
            	return factory(ChargeComponent::class)->create()->id;
            },
            'total_amount_id' => function(){
            	return factory(CurrencyAmount::class)->create()->id;
            },
    ];
});