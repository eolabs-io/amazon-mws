<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\ShipmentItem;
use Faker\Generator as Faker;

$factory->define(ShipmentItem::class, function (Faker $faker) {
    return [
            'seller_sku' => $faker->text(30),
            'order_item_id' => $faker->text(30),
            'order_adjustment_item_id' => $faker->text(30),
            'quantity_shipped' => $faker->numberBetween(1, 100),
            'cost_of_points_granted_id' => function(){
            	return factory(CurrencyAmount::class)->create()->id;
            },
            'cost_of_points_returned_id' => function(){
            	return factory(CurrencyAmount::class)->create()->id;
            },
    ];
});