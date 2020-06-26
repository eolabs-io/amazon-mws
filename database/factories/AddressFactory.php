<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Orders\Models\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
            'name' => $faker->name(),
            'address_line_1' => $faker->streetAddress,
            'address_line_2' => $faker->secondaryAddress,
            'address_line_3' => null,
            'city' => $faker->city,
            'municipality' => null,
            'county' => null,
            'district' => null,
            'state_or_region' => $faker->state,
            'postal_code' => $faker->postcode,
            'country_code' => $faker->countryCode,
            'phone' => $faker->phoneNumber,
            'address_type' => $faker->randomElement(['Commercial', 'Residential']),
    ];
});