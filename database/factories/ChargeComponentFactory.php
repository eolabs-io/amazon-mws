<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;

class ChargeComponentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChargeComponent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'charge_type' => $this->faker->randomElement(['Principal', 'Tax', 'MarketplaceFacilitatorTax', 'TCS-UTGST']),
            'charge_amount_id' => CurrencyAmount::factory(),
        ];
    }
}
