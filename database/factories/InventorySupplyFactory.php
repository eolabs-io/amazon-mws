<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Inventory\Models\InventorySupply;
use EolabsIo\AmazonMws\Domain\Shared\Models\Timepoint;
use Faker\Generator as Faker;

$factory->define(InventorySupply::class, function (Faker $faker) {

    $condition = $faker->randomElement(['NewItem','NewWithWarranty','NewOEM','NewOpenBox','UsedLikeNew','UsedVeryGood','UsedGood','UsedAcceptable','UsedPoor','UsedRefurbished','CollectibleLikeNew','CollectibleVeryGood','CollectibleGood','CollectibleAcceptable','CollectiblePoor','RefurbishedWithWarranty','Refurbished','Club',
    ]);

    return [
            'seller_sku' => $faker->unique()->text(14), 
            'fnsku' => $faker->unique()->text(14), 
            'asin' => $faker->unique()->text(14), 
            'condition' => $condition, 
            'total_supply_quantity' => $faker->numberBetween(1,9999), 
            'in_stock_supply_quantity' => $faker->numberBetween(1,9999),  
            'earliest_availability_id' => function () {
                return factory(Timepoint::class)->create()->id;
            }, 
    ];
});
