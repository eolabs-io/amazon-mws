<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Shared\Models\Timepoint;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

$factory->define(Timepoint::class, function (Faker $faker) {
	
	$type = $faker->randomElement(['Immediately' ,'DateTime', 'Unknown']);
    
    return [
            'timepoint_type' => $type, 
            'date_time' => function () use($type, $faker) {
            	return ($type === 'DateTime') ? $faker->dateTime() : null;
            },
    ];
});