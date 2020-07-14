<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\ServiceProviderCreditEvent;
use Faker\Generator as Faker;

$factory->define(ServiceProviderCreditEvent::class, function (Faker $faker) {
    return [
            'provider_transaction_type' => $faker->text(30),
			'seller_order_id' => $faker->text(30),
			'marketplace_id' => $faker->text(30),
			'marketplace_country_code' => $faker->text(30),
			'seller_id' => $faker->text(30),
			'seller_store_name' => $faker->text(30),
			'provider_id' => $faker->text(30),
			'provider_store_name' => $faker->text(30),
    ];
});