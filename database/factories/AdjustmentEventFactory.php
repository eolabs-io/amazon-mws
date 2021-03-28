<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\AdjustmentEvent;

class AdjustmentEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdjustmentEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'adjustment_type' => $this->faker->randomElement(['FBAInventoryReimbursement', 'ReserveEvent', 'SellerRewards']),
            'adjustment_amount_id' => CurrencyAmount::factory(),
            'posted_date' => $this->faker->dateTime(),
        ];
    }
}
