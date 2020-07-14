<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\AdjustmentEvent;
use EolabsIo\AmazonMws\Domain\Finance\Models\AdjustmentItem;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use Faker\Generator as Faker;

$factory->define(AdjustmentItem::class, function (Faker $faker) {
    return [
			'adjustment_event_id' => function() {
				return factory(AdjustmentEvent::class)->create()->id;
			},
            'quantity' => $faker->text(),
            'per_unit_amount_id' => function() {
            	return factory(CurrencyAmount::class)->create()->id;
            },
            'total_amount_id' => function() {
            	return factory(CurrencyAmount::class)->create()->id;
            },
            'seller_sku' => $faker->text(),
            'fn_sku' => $faker->text(),
            'product_description' => $faker->text(),
            'asin' => $faker->text(),
    ];
});