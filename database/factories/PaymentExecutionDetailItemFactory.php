<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use EolabsIo\AmazonMws\Domain\Orders\Models\Money;
use EolabsIo\AmazonMws\Domain\Orders\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Orders\Models\PaymentExecutionDetailItem;

class PaymentExecutionDetailItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaymentExecutionDetailItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'money_id' => Money::factory(),
            'payment_method' => $this->faker->randomElement(['COD' ,'GC', 'PointsAccount']),
            'order_id' => Order::factory(),
        ];
    }
}
