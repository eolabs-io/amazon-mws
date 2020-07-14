<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\ServiceFeeEvent;
use Faker\Generator as Faker;

$factory->define(ServiceFeeEvent::class, function (Faker $faker) {
    return [
            'amazon_order_id' => $faker->numerify('###-#######-#######'),
            'fee_reason' => $faker->text(),
            'seller_sku' => $faker->text(),
            'fn_sku' => $faker->text(),
            'fee_description' => $faker->text(),
            'asin' => $faker->text(),
    ];
});