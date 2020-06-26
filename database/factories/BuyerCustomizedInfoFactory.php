<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Orders\Models\BuyerCustomizedInfo;
use Faker\Generator as Faker;

$factory->define(BuyerCustomizedInfo::class, function (Faker $faker) {
    return [
            'customized_url' => $faker->url(),
    ];
});