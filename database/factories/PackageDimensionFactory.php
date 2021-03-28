<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Products\Models\PackageDimension;

class PackageDimensionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PackageDimension::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'height' => $this->faker->randomFloat(2, 0, 999),
            'length' => $this->faker->randomFloat(2, 0, 9999),
            'width' => $this->faker->randomFloat(2, 0, 999),
            'weight' => $this->faker->randomFloat(2, 0, 999),
            'dimension_units' => $this->faker->randomElement(['inch', 'cm']),
            'weight_units' => $this->faker->randomElement(['oz', 'lbs', 'kg']),
        ];
    }
}
