<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\SellerReviewEnrollmentPaymentEvent;

class SellerReviewEnrollmentPaymentEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SellerReviewEnrollmentPaymentEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'posted_date' => $this->faker->dateTime(),
            'enrollment_id' => $this->faker->text(),
            'parent_asin' => $this->faker->text(),
            'fee_component_id' => FeeComponent::factory(),
            'charge_component_id' => ChargeComponent::factory(),
            'total_amount_id' => CurrencyAmount::factory(),
        ];
    }
}
