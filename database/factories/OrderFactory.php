<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use EolabsIo\AmazonMwsClient\Models\Store;
use EolabsIo\AmazonMws\Domain\Orders\Models\Money;
use EolabsIo\AmazonMws\Domain\Orders\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Orders\Models\Address;
use EolabsIo\AmazonMws\Domain\Orders\Models\BuyerTaxInfo;
use EolabsIo\AmazonMws\Domain\Orders\Models\PaymentMethodDetail;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amazon_order_id' => $this->faker->numerify('###-#######-#######'),
            'seller_order_id' => $this->faker->numerify('##########'),
            'purchase_date' => $this->faker->dateTime(),
            'last_update_date' => $this->faker->dateTime(),
            'order_status' => $this->faker->randomElement(['PendingAvailability', 'Pending', 'Shipped', 'Canceled']),
            'fulfillment_channel' => $this->faker->randomElement(['AFN', 'MFN', null]),
            'sales_channel' => $this->faker->text(),
            'order_channel' => $this->faker->text(),
            'ship_service_level' => $this->faker->text(),
            'shipping_address_id' => Address::factory(),
            'order_total_id' => Money::factory(),
            'number_of_items_shipped' => $this->faker->numberBetween(1, 100),
            'number_of_items_unshipped' => $this->faker->randomDigit,
            'payment_method' => $this->faker->randomElement(['COD', 'CVS', 'Other', null]),
            'payment_method_details_id' => PaymentMethodDetail::factory(),
            'is_replacement_order' => $this->faker->boolean,
            'replaced_order_id' => $this->faker->numerify('###-#######-#######'),
            'marketplace_id' => $this->faker->text(),
            'buyer_email' => $this->faker->email,
            'buyer_name' => $this->faker->name(),
            'buyer_county' => $this->faker->country,
            'buyer_tax_info_id' => BuyerTaxInfo::factory(),
            'shipment_service_level_category' => $this->faker->randomElement(['Expedited', 'FreeEconomy', 'NextDay', 'SameDay',
                                                                    'SecondDay', 'Scheduled', 'Standard', null]),
            'easy_ship_shipment_status' => $this->faker->randomElement(['PendingPickUp', 'LabelCanceled', 'PickedUp', 'OutForDelivery',
                                                                  'Damaged', 'Delivered', 'RejectedByBuyer', 'Undeliverable',
                                                                  'ReturnedToSeller', 'ReturningToSeller', null]),
            'order_type' => $this->faker->randomElement(['StandardOrder', 'Preorder', 'SourcingOnDemandOrder', null]),
            'earliest_ship_date' => $this->faker->dateTime(),
            'latest_ship_date' => $this->faker->dateTime(),
            'earliest_delivery_date' => $this->faker->dateTime(),
            'latest_delivery_date' => $this->faker->dateTime(),
            'is_business_order' => $this->faker->boolean,
            'is_sold_by_ab' => $this->faker->boolean,
            'purchase_order_number' => $this->faker->text(),
            'is_prime' => $this->faker->boolean,
            'is_premium_order' => $this->faker->boolean,
            'is_global_express_enabled' => $this->faker->boolean,
            'promise_response_due_date' => $this->faker->dateTime(),
            'is_estimated_ship_dateset' => $this->faker->boolean,
            'store_id' => Store::factory(),
        ];
    }
}
