<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Products\Models\ItemDimension;

class ItemDimensionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ItemDimension::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'height' => $this->faker->randomFloat(2, 0, 9999999),
            'length' => $this->faker->randomFloat(2, 0, 99999999),
            'width' => $this->faker->randomFloat(2, 0, 99999999),
            'units' => $this->faker->randomElement(['inch', 'cm']),
        ];
    }
}
