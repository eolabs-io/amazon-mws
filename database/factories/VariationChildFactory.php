<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Products\Models\Product;
use EolabsIo\AmazonMws\Domain\Products\Models\VariationChild;
use Faker\Generator as Faker;

$factory->define(VariationChild::class, function (Faker $faker) {
    return [
            'product_id' => function() {
            	return factory(Product::class)->create()->id;
            },
            'color' => $faker->text(10),
            'size' => $faker->text(10),
    ];
});