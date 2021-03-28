<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Products\Models\Feature;
use EolabsIo\AmazonMws\Domain\Products\Models\ItemAttributes;

class FeatureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Feature::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'feature' => $this->faker->text(25),
            'item_attribute_id' => ItemAttributes::factory(),
        ];
    }
}
