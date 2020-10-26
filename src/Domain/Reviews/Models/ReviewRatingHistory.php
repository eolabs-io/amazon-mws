<?php

namespace EolabsIo\AmazonMws\Domain\Reviews\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewRatingHistory extends Model
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
}
