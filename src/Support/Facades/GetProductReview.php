<?php

namespace EolabsIo\AmazonMws\Support\Facades;

use Illuminate\Support\Facades\Facade;
use EolabsIo\AmazonMws\Tests\Fakes\GetProductReviewFake;

/**
 * @see EolabsIo\AmazonMws\Domain\Reviews\GetReviewRating
 */
class GetProductReview extends Facade
{
    public static function fake()
    {
        static::swap($fake = new GetProductReviewFake);

        return $fake;
    }


    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'get-product-review';
    }
}
