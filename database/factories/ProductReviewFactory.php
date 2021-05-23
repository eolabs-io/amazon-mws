<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReview;
use EolabsIo\AmazonMws\Domain\Reviews\Models\ProductReviewStatus;

class ProductReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductReview::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'asin' => $this->faker->text(30),
            'reviewId' => $this->faker->text(30),
            'profileName' => $this->faker->firstName,
            'starRating' => $this->faker->randomFloat(0, 5),
            'title' => $this->faker->text(10),
            'date' => $this->faker->date(),
            'verifiedPurchase' => $this->faker->boolean,
            'earlyReviewerRewards' => $this->faker->boolean,
            'vineVoice' => $this->faker->boolean,
            'body' => $this->faker->text(),
            'product_review_status_id' => ProductReviewStatus::factory(),
        ];
    }
}
