<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\ShipmentItem;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;

class ShipmentItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShipmentItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'seller_sku' => $this->faker->text(30),
            'order_item_id' => $this->faker->text(30),
            'order_adjustment_item_id' => $this->faker->text(30),
            'quantity_shipped' => $this->faker->numberBetween(1, 100),
            'cost_of_points_granted_id' =>CurrencyAmount::factory(),
            'cost_of_points_returned_id' =>CurrencyAmount::factory(),
        ];
    }
}
