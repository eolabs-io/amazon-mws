<?php

namespace EolabsIo\AmazonMws\Domain\Reviews\Listeners;

use EolabsIo\AmazonMws\Domain\Reviews\Events\FetchGetProductReview;
use EolabsIo\AmazonMws\Domain\Reviews\Jobs\PerformFetchGetProductReview;

class FetchGetProductReviewListener
{
    public function handle(FetchGetProductReview $event)
    {
        $getProductReview = $event->getProductReview;
        PerformFetchGetProductReview::dispatch($getProductReview)->onQueue('get-product-review');
    }
}
