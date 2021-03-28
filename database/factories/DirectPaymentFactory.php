<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\DirectPayment;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;

class DirectPaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DirectPayment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'direct_payment_type' => $this->faker->randomElement(['StoredValueCardRevenue', 'StoredValueCardRefund', 'PrivateLabelCreditCardRevenue']),
            'direct_payment_amount_id' => CurrencyAmount::factory(),
        ];
    }
}
