<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReview;
use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReviewImage;

class ProductReviewImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductReviewImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_review_id' => ProductReview::factory(),
            'url' => $this->faker->url(),
        ];
    }
}
