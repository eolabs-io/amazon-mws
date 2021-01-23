<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Shared\Models\Buyer;
use Faker\Generator as Faker;

$factory->define(Buyer::class, function (Faker $faker) {
    return [
            'email' => $faker->email,
            'name' => $faker->name(),
            'address_1' => $faker->streetAddress,
            'address_2' => $faker->secondaryAddress,
            'address_3' => null,
            'city' => $faker->city,
            'state' => $faker->state,
            'postal_code' => $faker->postcode,
            'country' => $faker->country,
            'phone_number' => $faker->phoneNumber,
    ];
});
