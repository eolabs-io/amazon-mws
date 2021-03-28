<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\RetrochargeEvent;

class RetrochargeEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RetrochargeEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'retrocharge_event_type' => $this->faker->randomElement(['Retrocharge', 'RetrochargeReversal']),
            'amazon_order_id' => $this->faker->text(30),
            'posted_date' => $this->faker->dateTime(),
            'base_tax_id' => CurrencyAmount::factory(),
            'shipping_tax_id' => CurrencyAmount::factory(),
            'marketplace_name' => $this->faker->text(30),
        ];
    }
}
