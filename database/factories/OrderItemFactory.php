<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use EolabsIo\AmazonMws\Domain\Orders\Models\Money;
use EolabsIo\AmazonMws\Domain\Orders\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Orders\Models\OrderItem;
use EolabsIo\AmazonMws\Domain\Orders\Models\ProductInfo;
use EolabsIo\AmazonMws\Domain\Orders\Models\PointsGranted;
use EolabsIo\AmazonMws\Domain\Orders\Models\TaxCollection;
use EolabsIo\AmazonMws\Domain\Orders\Models\BuyerCustomizedInfo;

class OrderItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amazon_order_id' => Order::factory()->create()->amazon_order_id,
            'ASIN' => $this->faker->numerify('B#########'),
            'order_item_id' => $this->faker->numerify('###-#######-#######'),
            'seller_sku' => $this->faker->numerify('##-####-####'),
            'buyer_customized_info_id' => BuyerCustomizedInfo::factory(),
            'title' => $this->faker->text(),
            'quantity_ordered' => $this->faker->numberBetween(1, 100),
            'quantity_shipped' => $this->faker->randomDigit,
            'points_granted_id' => PointsGranted::factory(),
            'product_info_id' => ProductInfo::factory(),
            'item_price_id' => Money::factory(),
            'shipping_price_id' => Money::factory(),
            'gift_wrap_price_id' => Money::factory(),
            'tax_collection_id' => TaxCollection::factory(),
            'item_tax_id' => Money::factory(),
            'shipping_tax_id' => Money::factory(),
            'gift_wrap_tax_id' => Money::factory(),
            'shipping_discount_id' => Money::factory(),
            'shipping_discount_tax_id' => Money::factory(),
            'promotion_discount_id' => Money::factory(),
            'promotion_discount_tax_id' => Money::factory(),
            // 'PromotionIds',
            'cod_fee_id' => Money::factory(),
            'cod_fee_discount_id' => Money::factory(),
            'is_gift' => $this->faker->boolean,
            'gift_message_text' => $this->faker->text(),
            'gift_wrap_level' => $this->faker->text(),
            'condition_note' => $this->faker->text(),
            'condition_id' => $this->faker->randomElement(['New', 'Used', 'Collectible', 'Refurbished', 'Preorder', 'Club', null]),
            'condition_subtype_id' => $this->faker->randomElement(['New', 'Mint', 'Very Good', 'Good', 'Acceptable', 'Poor', 'Club', 'OEM', 'Warranty', 'Refurbished', 'Warranty', 'Refurbished', 'Open Box', 'Any', 'Other', null]),
            'scheduled_delivery_start_date' => $this->faker->dateTime(),
            'scheduled_delivery_end_date' => $this->faker->dateTime(),
            'price_designation' => $this->faker->text(),
            'is_transparency' => $this->faker->boolean,
            'serial_number_required' => $this->faker->boolean,
        ];
    }
}
