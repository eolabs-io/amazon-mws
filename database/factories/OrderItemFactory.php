<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Orders\Models\BuyerCustomizedInfo;
use EolabsIo\AmazonMws\Domain\Orders\Models\Money;
use EolabsIo\AmazonMws\Domain\Orders\Models\Order;
use EolabsIo\AmazonMws\Domain\Orders\Models\OrderItem;
use EolabsIo\AmazonMws\Domain\Orders\Models\PointsGranted;
use EolabsIo\AmazonMws\Domain\Orders\Models\ProductInfo;
use EolabsIo\AmazonMws\Domain\Orders\Models\TaxCollection;
use Faker\Generator as Faker;

$factory->define(OrderItem::class, function (Faker $faker) {
    return [
            'amazon_order_id' => function() {
                return factory(Order::class)->create()->amazon_order_id;
            },
            'ASIN' => $faker->numerify('B#########'),
            'order_item_id' => $faker->numerify('###-#######-#######'),
            'seller_sku' => $faker->numerify('##-####-####'),
            'buyer_customized_info_id' => function() {
                return factory(BuyerCustomizedInfo::class)->create()->id;
            },
            'title' => $faker->text(),
            'quantity_ordered' => $faker->numberBetween(1, 100),
            'quantity_shipped' => $faker->randomDigit,
            'points_granted_id' => function() {
                return factory(PointsGranted::class)->create()->id;
            },
            'product_info_id' => function() {
                return factory(ProductInfo::class)->create()->id;
            },
            'item_price_id' => function() {
                return factory(Money::class)->create()->id;
            },
            'shipping_price_id' => function() {
                return factory(Money::class)->create()->id;
            },
            'gift_wrap_price_id' => function() {
                return factory(Money::class)->create()->id;
            },
            'tax_collection_id' => function() {
                return factory(TaxCollection::class)->create()->id;
            },
            'item_tax_id' => function() {
                return factory(Money::class)->create()->id;
            },
            'shipping_tax_id' => function() {
                return factory(Money::class)->create()->id;
            },
            'gift_wrap_tax_id' => function() {
                return factory(Money::class)->create()->id;
            },
            'shipping_discount_id' => function() {
                return factory(Money::class)->create()->id;
            },
            'shipping_discount_tax_id' => function() {
                return factory(Money::class)->create()->id;
            },
            'promotion_discount_id' => function() {
                return factory(Money::class)->create()->id;
            },
            'promotion_discount_tax_id' => function() {
                return factory(Money::class)->create()->id;
            },
            // 'PromotionIds',
            'cod_fee_id' => function() {
                return factory(Money::class)->create()->id;
            },
            'cod_fee_discount_id' => function() {
                return factory(Money::class)->create()->id;
            },
            'is_gift' => $faker->boolean,
            'gift_message_text' => $faker->text(),
            'gift_wrap_level' => $faker->text(),
            'condition_note' => $faker->text(),
            'condition_id' => $faker->randomElement(['New', 'Used', 'Collectible', 'Refurbished', 'Preorder', 'Club', null]),
            'condition_subtype_id' => $faker->randomElement(['New', 'Mint', 'Very Good', 'Good', 'Acceptable', 'Poor', 'Club', 'OEM', 'Warranty', 'Refurbished', 'Warranty', 'Refurbished', 'Open Box', 'Any', 'Other', null]),
            'scheduled_delivery_start_date' => $faker->dateTime(),
            'scheduled_delivery_end_date' => $faker->dateTime(),
            'price_designation' => $faker->text(),
            'is_transparency' => $faker->boolean,
            'serial_number_required' => $faker->boolean,
    ];

});