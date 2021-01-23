<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use EolabsIo\AmazonMws\Domain\Orders\Models\OrderItem;
use EolabsIo\AmazonMws\Domain\Reports\Models\AmazonFulfilledShipment;

$factory->define(AmazonFulfilledShipment::class, function (Faker $faker) {
    $orderItem = factory(OrderItem::class)->create();

    return [
            'amazon_order_id' => $orderItem->amazon_order_id,
            'merchant_order_id' => null,
            'shipment_id' => Str::random(),
            'shipment_item_id' => Str::random(),
            'amazon_order_item_id' => $orderItem->order_item_id,
            'merchant_order_item_id' => null,
            'purchase_date' => now()->subDays(2),
            'payments_date' => now()->subDays(2),
            'shipment_date' => now()->addDays(1),
            'reporting_date' => now(),
            'buyer_email' => $faker->email,
            'buyer_name' => $faker->name,
            'buyer_phone_number' => $faker->phoneNumber,
            'sku' => $orderItem->seller_sku,
            'product_name' => $faker->text(),
            'quantity_shipped' => $faker->randomNumber(2),
            'currency' => $faker->currencyCode,
            'item_price' => $faker->randomFloat(2, 10, 35),
            'item_tax' => 0.00,
            'shipping_price' => 0.00,
            'shipping_tax' => 0.00,
            'gift_wrap_price' => 0.00,
            'gift_wrap_tax' => 0.00,
            'ship_service_level' => $faker->randomElement(['Standard', 'Expedited', 'Priority']),
            'recipient_name' => $faker->name,
            'ship_address1' => $faker->streetAddress,
            'ship_address2' => null,
            'ship_address3' => null,
            'ship_city' => $faker->city,
            'ship_state' => $faker->state,
            'ship_postal_code' => $faker->postcode,
            'ship_country' => $faker->country,
            'ship_phone_number' => $faker->phoneNumber,
            'bill_address1' => $faker->streetAddress,
            'bill_address2' => null,
            'bill_address3' => null,
            'bill_city' => $faker->city,
            'bill_state' => $faker->state,
            'bill_postal_code' => $faker->postcode,
            'bill_country' => $faker->country,
            'item_promotion_discount' => 0.00,
            'ship_promotion_discount' => 0.00,
            'carrier' => $faker->randomElement(['AMZN_US', 'USPS', 'UPS']),
            'tracking_number' => $faker->randomNumber(),
            'estimated_arrival_date' => $faker->dateTime(),
            'fulfillment_center_id' => $faker->text(),
            'fulfillment_channel' => 'AFN',
            'sales_channel' => 'Amazon.com',
    ];
});
