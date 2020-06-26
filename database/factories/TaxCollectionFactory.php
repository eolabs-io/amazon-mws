<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Orders\Models\TaxCollection;

use Faker\Generator as Faker;

$factory->define(TaxCollection::class, function (Faker $faker) {
    return [
            'model' => $faker->text(30), 
            'responsible_party' => $faker->text(30),
    ];
});