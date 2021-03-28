<?php

namespace EolabsIo\AmazonMws\Domain\Reviews\Models;

use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Database\Factories\ReviewRatingHistoryFactory;

class ReviewRatingHistory extends AmazonMwsModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'asin',
                            'number_of_ratings',
                            'number_of_reviews',
                            'average_stars_rating'
                        ];


    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ReviewRatingHistoryFactory::new();
    }
}
