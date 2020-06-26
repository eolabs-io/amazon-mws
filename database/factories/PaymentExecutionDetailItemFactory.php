<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Orders\Models\Money;
use EolabsIo\AmazonMws\Domain\Orders\Models\Order;
use EolabsIo\AmazonMws\Domain\Orders\Models\PaymentExecutionDetailItem;
use Faker\Generator as Faker;

$factory->define(PaymentExecutionDetailItem::class, function (Faker $faker) {
    return [
    		'money_id' => function () {
				return factory(Money::class)->create()->id;
    		},
            'payment_method' => $faker->randomElement(['COD' ,'GC', 'PointsAccount']), 
            'order_id' => function() {
        		return factory(Order::class)->create()->id;
            }, 
    ];
});
