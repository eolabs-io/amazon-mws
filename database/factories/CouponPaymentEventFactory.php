<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\CouponPaymentEvent;

class CouponPaymentEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CouponPaymentEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'posted_date' => $this->faker->dateTime(),
            'coupon_id' => $this->faker->text(),
            'seller_coupon_description' => $this->faker->text(),
            'clip_or_redemption_count' => $this->faker->numberBetween(1, 9999),
            'payment_event_id' => $this->faker->text(),
            'fee_component_id' => FeeComponent::factory(),
            'charge_component_id' => ChargeComponent::factory(),
            'total_amount_id' => CurrencyAmount::factory(),
        ];
    }
}
