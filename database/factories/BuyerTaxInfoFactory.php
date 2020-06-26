<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Orders\Models\BuyerTaxInfo;

use Faker\Generator as Faker;

$factory->define(BuyerTaxInfo::class, function (Faker $faker) {
    return [
            'company_legal_name' => $faker->text(30), 
            'taxing_region' => $faker->text(30),
    ];
});