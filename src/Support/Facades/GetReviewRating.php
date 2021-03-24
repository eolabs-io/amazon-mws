<?php

namespace EolabsIo\AmazonMws\Support\Facades;

use Illuminate\Support\Facades\Facade;
use EolabsIo\AmazonMws\Tests\Fakes\GetReviewRatingFake;

/**
 * @see EolabsIo\AmazonMws\Domain\Reviews\GetReviewRating
 */
class GetReviewRating extends Facade
{
    public static function fake()
    {
        static::swap($fake = new GetReviewRatingFake);

        return $fake;
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'get-review-rating';
    }
}
