<?php

namespace EolabsIo\AmazonMws\Domain\Reviews\Listeners;

use EolabsIo\AmazonMws\Domain\Reviews\Events\FetchGetReviewRating;
use EolabsIo\AmazonMws\Domain\Reviews\Jobs\PerformFetchGetReviewRating;

class FetchGetReviewRatingListener
{
    public function handle(FetchGetReviewRating $event)
    {
        $getReviewRating = $event->getReviewRating;
        PerformFetchGetReviewRating::dispatch($getReviewRating)->onQueue('get-review-rating');
    }
}
