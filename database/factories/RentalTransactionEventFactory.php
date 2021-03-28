<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\RentalTransactionEvent;

class RentalTransactionEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RentalTransactionEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amazon_order_id' => $this->faker->text(30),
            'rental_event_type' => $this->faker->randomElement(['RentalCustomerPayment', 'RentalChargeFailureReimbursement']),
            'extension_length' => $this->faker->numberBetween(1, 100),
            'posted_date' => $this->faker->dateTime(),
            'marketplace_name' => $this->faker->text(30),
            'rental_initial_value_id' => CurrencyAmount::factory(),
            'rental_reimbursement_id' => CurrencyAmount::factory(),
        ];
    }
}
