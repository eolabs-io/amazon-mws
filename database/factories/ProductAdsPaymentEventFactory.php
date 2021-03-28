<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\ProductAdsPaymentEvent;

class ProductAdsPaymentEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductAdsPaymentEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'posted_date' => $this->faker->dateTime(),
            'transaction_type' => $this->faker->randomElement(['Charge', 'Refund',]),
            'invoice_id' => $this->faker->text(30),
            'base_value_id' => CurrencyAmount::factory(),
            'tax_value_id' => CurrencyAmount::factory(),
            'transaction_value_id' => CurrencyAmount::factory(),
        ];
    }
}
