<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use Faker\Generator as Faker;

$factory->define(ChargeComponent::class, function (Faker $faker) {
    return [
            'charge_type' => $faker->randomElement(['Principal', 'Tax', 'MarketplaceFacilitatorTax', 'TCS-UTGST']),
            'charge_amount_id' => function(){
            	return factory(CurrencyAmount::class)->create()->id;
            },
    ];
});