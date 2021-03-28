<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Orders\Models\Address;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'address_line_1' => $this->faker->streetAddress,
            'address_line_2' => $this->faker->secondaryAddress,
            'address_line_3' => null,
            'city' => $this->faker->city,
            'municipality' => null,
            'county' => null,
            'district' => null,
            'state_or_region' => $this->faker->state,
            'postal_code' => $this->faker->postcode,
            'country_code' => $this->faker->countryCode,
            'phone' => $this->faker->phoneNumber,
            'address_type' => $this->faker->randomElement(['Commercial', 'Residential']),
        ];
    }
}
