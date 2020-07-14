<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\PayWithAmazonEvent;
use Faker\Generator as Faker;

$factory->define(PayWithAmazonEvent::class, function (Faker $faker) {
    return [
            'seller_order_id' => $faker->text(30),
            'transaction_posted_date' => $faker->dateTime(),
            'business_object_type' => "PaymentContract",
            'sales_channel' => $faker->text(30),
            'charge_id' => function() {
                return factory(CurrencyAmount::class)->create()->id;
            },
            'payment_amount_type' => "Sales",
            'amount_description' => $faker->text(30),
            'fulfillment_channel' => $faker->randomElement(['AFN', 'MFN',]),
            'store_name' => $faker->text(30),
    ];
});