<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\TaxWithheldComponent;
use Faker\Generator as Faker;

$factory->define(TaxWithheldComponent::class, function (Faker $faker) {
    return [
            'tax_collection_model' => $faker->randomElement(['MarketplaceFacilitator', 'Standard']), 
    ];
});