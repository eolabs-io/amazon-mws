<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use EolabsIo\AmazonMws\Domain\Orders\Models\Money;
use Illuminate\Database\Eloquent\Factories\Factory;

class MoneyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Money::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'currency_code' => $this->faker->currencyCode,
            'amount' => (string) $this->faker->randomFloat(),
        ];
    }
}
