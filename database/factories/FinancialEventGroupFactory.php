<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\FinancialEventGroup;

class FinancialEventGroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FinancialEventGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'financial_event_group_id' => $this->faker->text(30),
            'processing_status' => $this->faker->randomElement(['Open', 'Closed']),
            'fund_transfer_status' => $this->faker->text(30),
            'original_total_id' => CurrencyAmount::factory(),
            'converted_total_id' => CurrencyAmount::factory(),
            'fund_transfer_date' => $this->faker->dateTime(),
            'trace_id' => $this->faker->text(30),
            'account_tail' => $this->faker->text(30),
            'beginning_balance_id' => CurrencyAmount::factory(),
            'financial_event_group_start' => $this->faker->dateTime(),
            'financial_event_group_end' => $this->faker->dateTime(),
        ];
    }
}
