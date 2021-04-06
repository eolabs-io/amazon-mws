<?php

namespace EolabsIo\AmazonMws\Support\Facades;

use Illuminate\Support\Facades\Facade;
use EolabsIo\AmazonMws\Tests\Fakes\GetProductReviewFake;
use EolabsIo\AmazonMws\Tests\Fakes\GetProductReviewWithImagesFake;
use EolabsIo\AmazonMws\Tests\Fakes\GetProductReviewWithCaptchaFake;

/**
 * @see EolabsIo\AmazonMws\Domain\Reviews\GetReviewRating
 */
class GetProductReview extends Facade
{
    public static function fake($options = [])
    {
        $type = data_get($options, 'type');
        $solverCallback = data_get($options, 'solverCallback');

        static::swap($fake = static::getProductReviewFake($type, $solverCallback));

        return $fake;
    }

    public static function getProductReviewFake($type, $solverCallback): GetProductReviewFake
    {
        switch ($type) {
            case '__WithImages__':
                return new GetProductReviewWithImagesFake;
            case '__WithCaptcha__':
                $productReviewWithCaptchaFake = new GetProductReviewWithCaptchaFake;
                $productReviewWithCaptchaFake->setMockedSolver($solverCallback());
                return $productReviewWithCaptchaFake;
            default:
                return new GetProductReviewFake;
        }
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
