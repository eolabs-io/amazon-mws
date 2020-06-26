<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Inventory\Models\InventorySupply;
use EolabsIo\AmazonMws\Domain\Inventory\Models\InventorySupplyDetail;
use EolabsIo\AmazonMws\Domain\Shared\Models\Timepoint;
use Faker\Generator as Faker;

$factory->define(InventorySupplyDetail::class, function (Faker $faker) {

	$supplyType = $faker->randomElement(['InStock' ,'Inbound', 'Transfer']);

    return [
    		'inventory_supply_id' => function () {
				return factory(InventorySupply::class)->create()->id;
    		},
            'quantity' => $faker->numberBetween(1,9999), 
            'supply_type' => $supplyType,
            'earliest_available_to_pick_id' => function () {
                return factory(Timepoint::class)->create()->id;
            },
            'latest_available_to_pick_id' => function () {
                return factory(Timepoint::class)->create()->id;
            },
    ];
});
