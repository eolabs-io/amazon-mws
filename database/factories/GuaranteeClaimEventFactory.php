<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\GuaranteeClaimEvent;

class GuaranteeClaimEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GuaranteeClaimEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amazon_order_id' => $this->faker->text(30),
            'seller_order_id' => $this->faker->text(30),
            'marketplace_name' => $this->faker->text(30),
            'posted_date' => $this->faker->dateTime(),
        ];
    }
}
