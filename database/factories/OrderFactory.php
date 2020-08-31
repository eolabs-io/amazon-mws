<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Orders\Models\Address;
use EolabsIo\AmazonMws\Domain\Orders\Models\BuyerTaxInfo;
use EolabsIo\AmazonMws\Domain\Orders\Models\Money;
use EolabsIo\AmazonMws\Domain\Orders\Models\Order;
use EolabsIo\AmazonMws\Domain\Orders\Models\PaymentMethodDetail;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
            'amazon_order_id' => $faker->numerify('###-#######-#######'),
            'seller_order_id' => $faker->numerify('##########'),
            'purchase_date' => $faker->dateTime(),
            'last_update_date' => $faker->dateTime(),
            'order_status' => $faker->randomElement(['PendingAvailability', 'Pending', 'Shipped', 'Canceled']),
            'fulfillment_channel' => $faker->randomElement(['AFN', 'MFN', null]),
            'sales_channel' => $faker->text(),
            'order_channel' => $faker->text(),
            'ship_service_level' => $faker->text(),
            'shipping_address_id' => function() {
                return factory(Address::class)->create()->id;
            },
            'order_total_id' => function() {
                return factory(Money::class)->create()->id;
            },
            'number_of_items_shipped' => $faker->numberBetween(1, 100),
            'number_of_items_unshipped' => $faker->randomDigit,
            'payment_method' => $faker->randomElement(['COD', 'CVS', 'Other', null]),
            'payment_method_details_id' => function() {
                return factory(PaymentMethodDetail::class)->create()->id;
            },
            'is_replacement_order' => $faker->boolean,
            'replaced_order_id' => $faker->numerify('###-#######-#######'),
            'marketplace_id' => $faker->text(),
            'buyer_email' => $faker->email,
            'buyer_name' => $faker->name(),
            'buyer_county' => $faker->country,
            'buyer_tax_info_id' => function() {
                return factory(BuyerTaxInfo::class)->create()->id;
            },
            'shipment_service_level_category' => $faker->randomElement(['Expedited', 'FreeEconomy', 'NextDay', 'SameDay', 
                                                                    'SecondDay', 'Scheduled', 'Standard', null]),
            'easy_ship_shipment_status' => $faker->randomElement(['PendingPickUp', 'LabelCanceled', 'PickedUp', 'OutForDelivery', 
                                                                  'Damaged', 'Delivered', 'RejectedByBuyer', 'Undeliverable', 
                                                                  'ReturnedToSeller', 'ReturningToSeller', null]),
            'order_type' => $faker->randomElement(['StandardOrder', 'Preorder', 'SourcingOnDemandOrder', null]),
            'earliest_ship_date' => $faker->dateTime(),
            'latest_ship_date' => $faker->dateTime(),
            'earliest_delivery_date' => $faker->dateTime(),
            'latest_delivery_date' => $faker->dateTime(),
            'is_business_order' => $faker->boolean,
            'is_sold_by_ab' => $faker->boolean,
            'purchase_order_number' => $faker->text(),
            'is_prime' => $faker->boolean,
            'is_premium_order' => $faker->boolean,
            'is_global_express_enabled' => $faker->boolean,
            'promise_response_due_date' => $faker->dateTime(),
            'is_estimated_ship_dateset' => $faker->boolean,
            'store_id' => function() {
                return factory(Store::class)->create()->id;
            },
    ];

});