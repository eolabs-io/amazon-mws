<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\DebtRecoveryEvent;

class DebtRecoveryEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DebtRecoveryEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'debt_recovery_type' => $this->faker->text(),
            'recovery_amount_id' => CurrencyAmount::factory(),
            'over_payment_credit_id' => CurrencyAmount::factory(),
        ];
    }
}
