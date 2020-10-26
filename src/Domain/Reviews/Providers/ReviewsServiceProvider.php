<?php

namespace EolabsIo\AmazonMws\Domain\Reviews\Providers;

use EolabsIo\AmazonMws\Domain\Reviews\Events\FetchGetReviewRating;
use EolabsIo\AmazonMws\Domain\Reviews\Events\FetchGetProductReview;
use EolabsIo\AmazonMws\Domain\Reviews\Listeners\FetchGetReviewRatingListener;
use EolabsIo\AmazonMws\Domain\Reviews\Listeners\FetchGetProductReviewListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class ReviewsServiceProvider extends ServiceProvider
{
    protected $listen = [
        FetchGetReviewRating::class => [
            FetchGetReviewRatingListener::class,
        ],
        FetchGetProductReview::class => [
            FetchGetProductReviewListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
