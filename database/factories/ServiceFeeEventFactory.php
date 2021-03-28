<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Finance\Models\ServiceFeeEvent;

class ServiceFeeEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ServiceFeeEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amazon_order_id' => $this->faker->numerify('###-#######-#######'),
            'fee_reason' => $this->faker->text(),
            'seller_sku' => $this->faker->text(),
            'fn_sku' => $this->faker->text(),
            'fee_description' => $this->faker->text(),
            'asin' => $this->faker->text(),
        ];
    }
}
