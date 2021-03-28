<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\DebtRecoveryItem;

class DebtRecoveryItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DebtRecoveryItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'recovery_amount_id' => CurrencyAmount::factory(),
            'original_amount_id' => CurrencyAmount::factory(),
            'group_begin_date' => $this->faker->dateTime(),
            'group_end_date' => $this->faker->dateTime(),
        ];
    }
}
