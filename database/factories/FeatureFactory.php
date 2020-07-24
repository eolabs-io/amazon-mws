<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Products\Models\Feature;
use EolabsIo\AmazonMws\Domain\Products\Models\ItemAttributes;
use Faker\Generator as Faker;

$factory->define(Feature::class, function (Faker $faker) {
    return [
            'feature' => $faker->text(25),
            'item_attribute_id' => function() {
            	return factory(ItemAttributes::class)->create()->id;
            },
    ];
});