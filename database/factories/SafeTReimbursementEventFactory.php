<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\SafeTReimbursementEvent;

class SafeTReimbursementEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SafeTReimbursementEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'posted_date' => $this->faker->dateTime(),
            'safe_t_claim_id' => $this->faker->text(),
            'reimbursed_amount_id' => CurrencyAmount::factory(),
        ];
    }
}
