<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Orders\Models\PaymentMethodDetail;

class PaymentMethodDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaymentMethodDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'payment_method_detail' => $this->faker->randomElement(['GiftCertificate', 'CreditCard']),
        ];
    }
}
