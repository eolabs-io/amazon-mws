<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\NetworkComminglingTransactionEvent;

class NetworkComminglingTransactionEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NetworkComminglingTransactionEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'posted_date' => $this->faker->dateTime(),
            'net_co_transaction_id' => $this->faker->text(30),
            'swap_reason' => $this->faker->text(30),
            'transaction_type' => $this->faker->text(30),
            'asin' => $this->faker->text(30),
            'marketplace_id' => $this->faker->text(30),
            'tax_exclusive_amount_id' => CurrencyAmount::factory(),
            'tax_amount_id' => CurrencyAmount::factory(),
        ];
    }
}
