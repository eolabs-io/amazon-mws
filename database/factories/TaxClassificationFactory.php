<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Orders\Models\BuyerTaxInfo;
use EolabsIo\AmazonMws\Domain\Orders\Models\TaxClassification;
use Faker\Generator as Faker;

$factory->define(TaxClassification::class, function (Faker $faker) {
    return [
            'name' => $faker->text(30), 
            'value' => $faker->text(30),
            'buyer_tax_info_id' => function() {
            	return factory(BuyerTaxInfo::class)->create()->id;
            }
    ];
});