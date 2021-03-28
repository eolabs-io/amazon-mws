<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\Promotion;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;

class PromotionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Promotion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'promotion_type' => $this->faker->text(30),
            'promotion_id' => $this->faker->text(30),
            'promotion_amount_id' => CurrencyAmount::factory(),
        ];
    }
}
