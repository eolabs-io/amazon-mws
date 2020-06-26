<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Orders\Models\PaymentMethodDetail;
use Faker\Generator as Faker;

$factory->define(PaymentMethodDetail::class, function (Faker $faker) {
    return [
            'payment_method_detail' => $faker->randomElement(['GiftCertificate', 'CreditCard']),
    ];
});