<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\AdjustmentItem;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\AdjustmentEvent;

class AdjustmentItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdjustmentItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'adjustment_event_id' => AdjustmentEvent::factory(),
            'quantity' => $this->faker->text(),
            'per_unit_amount_id' => CurrencyAmount::factory(),
            'total_amount_id' => CurrencyAmount::factory(),
            'seller_sku' => $this->faker->text(),
            'fn_sku' => $this->faker->text(),
            'product_description' => $this->faker->text(),
            'asin' => $this->faker->text(),
        ];
    }
}
