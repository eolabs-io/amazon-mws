<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Orders\Models\OrderItem;
use EolabsIo\AmazonMws\Domain\Reports\Models\AmazonFulfilledShipment;

class AmazonFulfilledShipmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AmazonFulfilledShipment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $orderItem = OrderItem::factory()->create();

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
            'buyer_email' => $this->faker->email,
            'buyer_name' => $this->faker->name,
            'buyer_phone_number' => $this->faker->phoneNumber,
            'sku' => $orderItem->seller_sku,
            'product_name' => $this->faker->text(),
            'quantity_shipped' => $this->faker->randomNumber(2),
            'currency' => $this->faker->currencyCode,
            'item_price' => $this->faker->randomFloat(2, 10, 35),
            'item_tax' => 0.00,
            'shipping_price' => 0.00,
            'shipping_tax' => 0.00,
            'gift_wrap_price' => 0.00,
            'gift_wrap_tax' => 0.00,
            'ship_service_level' => $this->faker->randomElement(['Standard', 'Expedited', 'Priority']),
            'recipient_name' => $this->faker->name,
            'ship_address1' => $this->faker->streetAddress,
            'ship_address2' => null,
            'ship_address3' => null,
            'ship_city' => $this->faker->city,
            'ship_state' => $this->faker->state,
            'ship_postal_code' => $this->faker->postcode,
            'ship_country' => $this->faker->country,
            'ship_phone_number' => $this->faker->phoneNumber,
            'bill_address1' => $this->faker->streetAddress,
            'bill_address2' => null,
            'bill_address3' => null,
            'bill_city' => $this->faker->city,
            'bill_state' => $this->faker->state,
            'bill_postal_code' => $this->faker->postcode,
            'bill_country' => $this->faker->country,
            'item_promotion_discount' => 0.00,
            'ship_promotion_discount' => 0.00,
            'carrier' => $this->faker->randomElement(['AMZN_US', 'USPS', 'UPS']),
            'tracking_number' => $this->faker->randomNumber(),
            'estimated_arrival_date' => $this->faker->dateTime(),
            'fulfillment_center_id' => $this->faker->text(),
            'fulfillment_channel' => 'AFN',
            'sales_channel' => 'Amazon.com',
        ];
    }
}
