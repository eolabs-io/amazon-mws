<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;

class FeeComponentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FeeComponent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fee_type' => $this->faker->randomElement(['Commission', 'CouponClipFee', 'CouponRedemptionFee', 'CSBAFee']),
            'fee_amount_id' => CurrencyAmount::factory(),
        ];
    }
}
