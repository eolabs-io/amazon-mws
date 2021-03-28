<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Products\Models\Image;
use EolabsIo\AmazonMws\Domain\Products\Models\Product;
use EolabsIo\AmazonMws\Domain\Products\Models\ItemDimension;
use EolabsIo\AmazonMws\Domain\Products\Models\ItemAttributes;
use EolabsIo\AmazonMws\Domain\Products\Models\PackageDimension;

class ItemAttributesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ItemAttributes::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'binding' => $this->faker->text(30),
            'brand' => $this->faker->text(30),
            'is_adult_product' => $this->faker->boolean,
            'label' => $this->faker->text(30),
            'manufacturer' => $this->faker->text(30),
            'package_quantity' => $this->faker->randomNumber(),
            'part_number' => $this->faker->text(30),
            'product_group' => $this->faker->text(30),
            'product_type_name' => $this->faker->text(30),
            'publisher' => $this->faker->text(30),
            'size' => $this->faker->text(30),
            'studio' => $this->faker->text(30),
            'title' => $this->faker->text(30),
            'product_id' => Product::factory(),
            'item_dimension_id' => ItemDimension::factory(),
            'package_dimension_id' => PackageDimension::factory(),
            'small_image_id' => Image::factory(),
        ];
    }
}
