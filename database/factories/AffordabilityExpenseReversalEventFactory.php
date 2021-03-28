<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\AffordabilityExpenseReversalEvent;

class AffordabilityExpenseReversalEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AffordabilityExpenseReversalEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'posted_date' => $this->faker->dateTime(),
            'transaction_type' => $this->faker->text(30),
            'amazon_order_id' => $this->faker->text(30),
            'base_expense_id' => CurrencyAmount::factory(),
            'total_expense_id' => CurrencyAmount::factory(),
            'tax_type_igst_id' => CurrencyAmount::factory(),
            'tax_type_cgst_id' => CurrencyAmount::factory(),
            'tax_type_sgst_id' => CurrencyAmount::factory(),
            'marketplace_id' => $this->faker->text(30),
        ];
    }
}
