<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\AffordabilityExpenseEvent;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use Faker\Generator as Faker;

$factory->define(AffordabilityExpenseEvent::class, function (Faker $faker) {
    return [
			'posted_date' => $faker->dateTime(),
            'transaction_type' => $faker->text(30),
            'amazon_order_id' => $faker->text(30),
            'base_expense_id' => function() {
            	return factory(CurrencyAmount::class)->create()->id;
            },
            'total_expense_id' => function() {
            	return factory(CurrencyAmount::class)->create()->id;
            },
            'tax_type_igst_id' => function() {
                return factory(CurrencyAmount::class)->create()->id;
            },
            'tax_type_cgst_id' => function() {
                return factory(CurrencyAmount::class)->create()->id;
            },
            'tax_type_sgst_id' => function() {
                return factory(CurrencyAmount::class)->create()->id;
            },
            'marketplace_id' => $faker->text(30),
    ];
});