<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\GuaranteeClaimEvent;
use Faker\Generator as Faker;

$factory->define(GuaranteeClaimEvent::class, function (Faker $faker) {
    return [
            'amazon_order_id' => $faker->text(30),
            'seller_order_id' => $faker->text(30),
            'marketplace_name' => $faker->text(30),
            'posted_date' => $faker->dateTime(),
    ];
});
