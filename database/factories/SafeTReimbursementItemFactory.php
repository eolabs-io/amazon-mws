<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Finance\Models\SafeTReimbursementEvent;
use EolabsIo\AmazonMws\Domain\Finance\Models\SafeTReimbursementItem;
use Faker\Generator as Faker;

$factory->define(SafeTReimbursementItem::class, function (Faker $faker) {
    return [
    		'safe_t_reimbursement_event_id' => function() { 
    			return factory(SafeTReimbursementEvent::class)->create()->id;
    		},
    ];
});