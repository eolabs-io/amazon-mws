<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Products\Models\Image;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url' => $this->faker->url(),
            'height' => $this->faker->randomFloat(2, 0, 999999),
            'width' => $this->faker->randomFloat(2, 0, 999999),
            'units' => $this->faker->randomElement(['Pixels', 'inch', 'cm']),
        ];
    }
}
