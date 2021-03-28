<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\FBALiquidationEvent;

class FBALiquidationEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FBALiquidationEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'posted_date' => $this->faker->dateTime(),
            'original_removal_order_id' => $this->faker->text(),
            'liquidation_proceeds_amount_id' => CurrencyAmount::factory(),
            'liquidation_fee_amount_id' => CurrencyAmount::factory(),
        ];
    }
}
