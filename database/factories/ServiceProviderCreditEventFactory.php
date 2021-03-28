<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\ServiceProviderCreditEvent;

class ServiceProviderCreditEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ServiceProviderCreditEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'provider_transaction_type' => $this->faker->text(30),
            'seller_order_id' => $this->faker->text(30),
            'marketplace_id' => $this->faker->text(30),
            'marketplace_country_code' => $this->faker->text(30),
            'seller_id' => $this->faker->text(30),
            'seller_store_name' => $this->faker->text(30),
            'provider_id' => $this->faker->text(30),
            'provider_store_name' => $this->faker->text(30),
        ];
    }
}
