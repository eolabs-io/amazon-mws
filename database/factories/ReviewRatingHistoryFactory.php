<?php

namespace EolabsIo\AmazonMws\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\AmazonMws\Domain\Reviews\Models\ReviewRatingHistory;

class ReviewRatingHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ReviewRatingHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'asin' => $this->faker->numerify('B###########'),
            'number_of_ratings' => $this->faker->numberBetween(0, 9999),
            'number_of_reviews' => $this->faker->numberBetween(0, 9999),
            'average_stars_rating' => $this->faker->randomFloat(0.0, 5.0),
        ];
    }
}
