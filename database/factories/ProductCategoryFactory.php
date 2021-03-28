<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Products\Models\ProductCategory;

class ProductCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_category_id' => Str::random(20),
            'product_category_name' => $this->faker->text(20),
            'parent_id' => null,
        ];
    }
}
