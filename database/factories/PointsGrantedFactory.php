<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use EolabsIo\AmazonMws\Domain\Orders\Models\Money;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Orders\Models\PointsGranted;

class PointsGrantedFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PointsGranted::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'points_number' => $this->faker->randomDigit,
            'points_monetary_value_id' => Money::factory(),
        ];
    }
}
