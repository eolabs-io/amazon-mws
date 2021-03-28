<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\TDSReimbursementEvent;

class TDSReimbursementEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TDSReimbursementEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'posted_date' => $this->faker->dateTime(),
            'tds_order_id' => $this->faker->text(30),
            'reimbursed_amount_id' => CurrencyAmount::factory(),
        ];
    }
}
