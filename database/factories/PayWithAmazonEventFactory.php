<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\PayWithAmazonEvent;

class PayWithAmazonEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PayWithAmazonEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'seller_order_id' => $this->faker->text(30),
            'transaction_posted_date' => $this->faker->dateTime(),
            'business_object_type' => "PaymentContract",
            'sales_channel' => $this->faker->text(30),
            'charge_id' => CurrencyAmount::factory(),
            'payment_amount_type' => "Sales",
            'amount_description' => $this->faker->text(30),
            'fulfillment_channel' => $this->faker->randomElement(['AFN', 'MFN',]),
            'store_name' => $this->faker->text(30),
        ];
    }
}
