<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use EolabsIo\AmazonMws\Domain\Shared\Models\Buyer;
use Illuminate\Database\Eloquent\Factories\Factory;

class BuyerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Buyer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->email,
            'name' => $this->faker->name(),
            'address_1' => $this->faker->streetAddress,
            'address_2' => $this->faker->secondaryAddress,
            'address_3' => null,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'postal_code' => $this->faker->postcode,
            'country' => $this->faker->country,
            'phone_number' => $this->faker->phoneNumber,
        ];
    }
}
