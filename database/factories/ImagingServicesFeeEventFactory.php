<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\ImagingServicesFeeEvent;
use Faker\Generator as Faker;

$factory->define(ImagingServicesFeeEvent::class, function (Faker $faker) {
    return [
            'imaging_request_billing_item_id' => $faker->text(),
            'asin' => $faker->text(),
            'posted_date' => $faker->dateTime(),
    ];
});