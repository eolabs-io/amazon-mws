<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\LoanServicingEvent;

class LoanServicingEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LoanServicingEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'source_business_event_type' => $this->faker->randomElement(['LoanAdvance', 'LoanPayment', 'LoanRefund']),
            'loan_amount_id' => CurrencyAmount::factory(),
        ];
    }
}
